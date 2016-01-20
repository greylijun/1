/**
 * Created by LiJun on 2015/12/31.
 */
$(document).ready(function(){
    text = document.getElementById("keys");
    list = document.getElementById("possible");
    $("#revise_type").change(function(){
       if($("#revise_type").val() == "月数据修正"){
           document.getElementById("day").style.display = "none";
           document.getElementById("month").style.display = "block";
           document.getElementById("month2").style.display = "block";
       }
        if($("#revise_type").val() == "日数据修正"){
            document.getElementById("day").style.display = "block";
            document.getElementById("month").style.display = "none";
            document.getElementById("month2").style.display = "none";
        }
    });
    $("#query").click(function(){
        if($("#revise_type").val() == "日数据修正"){
            if(!isNotNULL('day_select','日期选择')){
                $.getJSON("data_revise.php",{
                    'unit':$("#keys").val(),
                    'energy_type':$("#energy_type").val(),
                    'revise_type':$("#revise_type").val(),
                    'day':$("#day_select").val()
                },function(json){
                    if(json == ""){
                        sweetAlert("当前状态不存在相关数据信息，请重新选择查询条件！");
                    }else{
                        $("#original_equ_data").val(json.daily_equival_value);
                        $("#original_ind_data").val(json.daily_indiff_value);
                    }
                });
            }
        }
        if($("#revise_type").val() == "月数据修正"){
            $.getJSON("data_revise.php",{
                'unit':$("#keys").val(),
                'energy_type':$("#energy_type").val(),
                'revise_type':$("#revise_type").val(),
                'year_select':$("#year_select").val(),
                'month_select':$("#month_select").val()
            },function(json){
                if(json.day_time == null){
                    sweetAlert("当前状态不存在相关数据信息，请重新选择查询条件！");
                }else{
                    $("#original_equ_data").val(json.daily_equival_value);
                    $("#original_ind_data").val(json.daily_indiff_value);
                }
            });
        }
    });
    $("#submit").click(function(){
        if($("#revise_type").val() == "日数据修正"){
            $.post("update_data.php",{
                'unit':$("#keys").val(),
                'energy_type':$("#energy_type").val(),
                'revise_type':$("#revise_type").val(),
                'day':$("#day_select").val(),
                'original_equ_value':$("#original_equ_data").val(),
                'original_ind_value':$("#original_ind_data").val(),
                'revise_equ_value':$("#revise_equ_data").val(),
                'revise_ind_value':$("#revise_ind_data").val()
            },function(json){
                if(json.substr(4,4) == '8006'){
                    sweetAlert("数据修改成功！");
                }else{
                    sweetAlert('数据修改失败！');
                }
            })
        }
        if($("#revise_type").val() == "月数据修正"){
            $.post("update_data.php",{
                'unit':$("#keys").val(),
                'energy_type':$("#energy_type").val(),
                'revise_type':$("#revise_type").val(),
                'year_select':$("#year_select").val(),
                'month_select':$("#month_select").val(),
                'original_equ_value':$("#original_equ_data").val(),
                'original_ind_value':$("#original_ind_data").val(),
                'revise_equ_value':$("#revise_equ_data").val(),
                'revise_ind_value':$("#revise_ind_data").val()
            },function(json){
                if(json.substr(4,4) == '8006'){
                    sweetAlert("数据修改成功！");
                }else{
                    sweetAlert('数据修改失败！');
                }
            })
        }
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
        $.post("../../utils/math_enterprise.php", {
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
                list.style.height = "25px";
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
        document.getElementById("possible").style.display = "none";
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
    document.getElementById("possible").style.display = "none";
}

//按钮提交表单方法
function btnSubmit(){
    //加一个控制，防止非法提交
    if(document.getElementById("keys").value == ""){
        sweetAlert("请输入企业名！");
    }
}

function isNotNULL(key,value){
    if($("#"+ key ).val() == ""){
        sweetAlert(value+"不能为空！");
        return true;
    }else{
        return false;
    }
}
