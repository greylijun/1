/**
 * Created by zhangliqin on 2015/11/4.
 */
$(document).ready(function(){
    text = document.getElementById("keys");
    list = document.getElementById("possibility");
    $.getJSON("energy_big_enter.php",function(json){
       show_table(json);
    });
    $(".menu li").click(function(){
        $("#area_name").text($(this).html());
        $(".menu li").removeClass('on');
        $(this).addClass('on');
    });
//当量和等价切换
    $('#equivalent_value').click(function () {
        $(".bar li").removeClass('on');
        $(this).addClass('on');
    });
    $('#weight_value').click(function () {
        $(".bar li").removeClass('on');
        $(this).addClass('on');
    });

});

//保存文本框上一个value
var forwardValue="";
//文本框对象
var text;
//ul列表对象
//是否隐藏ul列表标记
var isHide = true;

//循环检测文本框内容是否改变
function checkTextValue(){
    //内容一旦改变，清空ul列表
    list.innerHTML = "";
    //内容一旦改变，重置当前li节点
    currentli = null;
    //记录新内容
    forwardValue = text.value;
    if(forwardValue != ""){
        $.post("math_enterprise.php", {
                textValue:forwardValue
            }, function(json){
                //判断文本框是否为空
                var enter_name = $.parseJSON(json);
                if(enter_name.length != 0){
                    //更新匹配列表
                    for(var i=0;i<enter_name.length;i++){
                        //创建一个a标签
                        var a = document.createElement("a");
                        //设置a标签的显示内容
                        //这里应该从具体的接口获取数据
                        a.innerHTML = enter_name[i];
                        //设置a标签的href属性
                        //直接调用提交表单方法，参数是改a标签的文本值（显示内容）
                        a.href = "javascript:listSubmit('"+(enter_name[i])+"');";
                        //给a标签添加鼠标移入事件
                        a.onmouseover = onmouseover;
                        //给a标签添加鼠标移出事件
                        a.onmouseout = onmouseout;
                        //创建一个li标签
                        var li = document.createElement("li");
                        //把a标签插入到li标签中
                        li.appendChild(a);
                        //把li标签填入ul中
                        list.appendChild(li);
                    }
                    //显示ul列表
                    list.style.display = "block";
                    list.style.height = "75px";
                }else{
                    //如果为空，隐藏ul列表
                    list.style.display = "none";
                    list.style.height = "0px";
                }
            });
    }else{
        list.style.display = "none";
        list.style.height = "0px";
    }
}

//文本框失去焦点处理
function hideul(){
    //判断是否需要隐藏，在ul列表中点击鼠标时不能隐藏，隐藏了无法跳转
    if(isHide){
        //隐藏ul列表
        document.getElementById("possibility").style.display = "none";
    }
}

//li中超链接鼠标移入处理
function onmouseover(){
    isHide=false;
}

//li中超链接鼠标移出事件处理
function onmouseout(){
    isHide=true;
}

//列表提交表单方法
function listSubmit(value){
    //给文本框赋值
    text.value=value;
    //手动提交表单
    ajaxSubmit();
}

//按钮提交表单方法
function btnSubmit(){
    //加一个控制，防止非法提交
    if(document.getElementById("keys").value != ""){
        //不为空则提交表单
        ajaxSubmit();
    }else{
        alert("请输入企业名！");
    }
}

function ajaxSubmit(){
    $.post("unit_query.php", {
            keys:$("#keys").val()
        }, function(json){
            switch(json){
                case '10000':
                    alert("不存在该企业！");
                    break;
                case '10010':
                    location.href = 'unit_intro/unit_intro.php';
                    break;
                default:
                    break;
            }
        }
    )
}

function show_table(json){
    for(i=0;i<json.length;i++){
        var table = "<table><tr>";
        var td ="<td><a href='unit_intro/unit_intro.php?organization_code="+json[i].org_code+"'>"+json[i].name+"</a></td><td>"+json[i].region+"</td><td>"+json[i].address+"</td><td rowspan='2'><img src=../"+json[i].image+"></td></tr>";
        var td2 = "<tr><td><p>采集点总数：</p>"+json[i].num+"个</td><td colspan='2'><p>上个月当量用能量：</p>"+json[i].last_total+"吨标煤</td></tr></table>";
        var div = table+td+td2;
        $("#total_five").append(div);
    }
}