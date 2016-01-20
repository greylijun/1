/**
 * Created by LiJun on 2016/1/19.
 */
$(document).ready(function(){
    $("#query").click(function(){
        if(!isNotNull('unit','单位名称')){
            $("#site_query").empty();
            $.getJSON("site_operation_query.php",{
                'unit':$("#unit").val(),
                'energy_type':$("#energy_type").val(),
                'model_number':$("#model_number").val()
            },function (json) {
                if(json == ""){
                    //document.getElementById("page").style.display = "none";
                    sweetAlert("当前状态不存在通讯模块信息！");
                }else{
                    showQueryTable(json);
                    $("div.page").jPages({
                        containerID:" site_query",
                        previous:"上一页",
                        next:"下一页",
                        first:"第一页",
                        last:"最后一页",
                        perPage:4,
                        delay:5
                    });
                }
            });
        }
    });

//增加信息部分单位名称搜索框
    text = document.getElementById("InsertUnitName");
    list = document.getElementById("possible");

    //能源一览表搜索框
    unit = document.getElementById("unit");
    list2 = document.getElementById("unit_possible");
    QuerySpecificResourceType();
    $("#add").click(function(){
        if(!isNotNull('InsertUnitName','单位名称') && !isNotNull('InsertModuleId','管理编号') && !isNotNull('EquipmentName','器具名称') && !isNotNull('Model','型号')){
            $.post("add_new_equipment.php",{
                'InsertUnitName':$("#InsertUnitName").val(),
                'InsertModuleId':$("#InsertModuleId").val(),
                'InsertUpperLevelModuleId':$("#InsertUpperLevelModuleId").val(),
                'InsertMeterLevel':$("#InsertMeterLevel").val(),
                'InsertResourceType':$("#InsertResourceType").val(),
                'InsertSpecificResourceType':$("#InsertSpecificResourceType").val(),
                'InsertEquivalentCoefficient':$("#InsertEquivalentCoefficient").val(),
                'InsertEquivalentFactor':$("#InsertEquivalentFactor").val(),
                'EquipmentName':$("#EquipmentName").val(),
                'Model':$("#Model").val()
            },function(json){
                if(json == '8006'){
                    $("input[name='equipment']").val("");
                    sweetAlert("设备增加成功！");
                }else{
                    sweetAlert("设别增加失败！");
                }
            });
        }
    });
});

function showQueryTable(json){
    var divnum = 1;
    for(var i = 0;i<json.length;i++){
        var data = json[i];
        var td = "<tr><td>"+divnum+"</td><td>"+data.unit_name+"</td><td id='path_number"+divnum+"'>"+data.path_number+"</td><td>"+data.last_grade_number+"</td><td>"+data.grade_table+"</td><td>"+data.energy_big_type+"</td><td>"+data.energy_small_name+"</td><td>"+data.point_equival_standard+"</td><td>"+data.point_indiff_standard+"</td><td>"+data.instrument_name+"</td><td>"+data.model_num+"</td><td><input class='btn' readonly value='删除' onclick='delete_num("+divnum+")'></td></tr>";
        $("#site_query").append(td);
        divnum++;
    }
}

function delete_num(divnum){
    var path_num = $("#path_number"+divnum).html();
    swal({
        title: "确定删除该通讯模块吗？",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是",
        closeOnConfirm: false
    },function(){
        $.post("delete_path.php",{
            'path_num':path_num
        },function(json){
            if(json == '8006'){
                sweetAlert("通讯模块删除成功！");
            }else{
                sweetAlert("通讯模块删除失败！");
            }
        });
    });
}

//资源类型切换对具体资源类型的影响
function QuerySpecificResourceType(){
    $.getJSON("source_type_match.php",{
        'InsertResourceType':$("#InsertResourceType").val()
    },function(json){
        $("#InsertSpecificResourceType").empty();
       for(var i = 0;i<json.length;i++){
           var data = json[i];
           $("#InsertSpecificResourceType").append("<option value='"+data+"'>"+data+"</option>")
       }
        ChangeFactor();
    });
}

//具体资源类型变化对系数影响
function ChangeFactor(){
    $.getJSON("factor_match.php",{
        'InsertSpecificResourceType':$("#InsertSpecificResourceType").val()
    },function(json){
        $("#InsertEquivalentCoefficient").val(json.standard_equ_fold);
        $("#InsertEquivalentFactor").val(json.standard_equ_discount);
    });
}

function isNotNull(key,value){
    if($('#'+key).val() == ""){
        sweetAlert(value+"不能为空！");
        return true;
    }else{
        return false;
    }
}

//保存文本框上一个value
var forwardValue="";

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
                list.style.height = "75px";
                list.style.width = "194.5px";
                list.style.background = "white";
            }else{
                //如果为空，隐藏ul列表
                list.style.display = "none";
                list.style.height = "0px";
                list.style.background = "white";
            }
        });
    }else{
        list.style.display = "none";
        list.style.height = "0px";
        list.style.background = "white";
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


//能源计量通讯模块一览表搜索框

//保存文本框上一个value
var forward="";

function checkUnitValue(){
    //内容一旦改变，清空ul列表
    list2.innerHTML = "";
    //内容一旦改变，重置当前li节点
    currentli = null;
    //记录新内容
    forward = unit.value;
    if(forward != ""){
        $.post("../../utils/math_enterprise.php", {
            textValue:forward
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
                    a.href = "javascript:listSubmit2('"+(enter_name[i])+"');";
                    //给a标签添加鼠标移入事件
                    a.onmouseover = onmouseover;
                    //给a标签添加鼠标移出事件
                    a.onmouseout = onmouseout;
                    //创建一个li标签
                    var li = document.createElement("li");
                    //把a标签插入到li标签中
                    li.appendChild(a);
                    //把li标签填入ul中
                    list2.appendChild(li);
                }
                //显示ul列表
                list2.style.display = "block";
                list2.style.height = "75px";
                list2.style.width = "194.5px";
                list2.style.background = "white";
            }else{
                //如果为空，隐藏ul列表
                list2.style.display = "none";
                list2.style.height = "0px";
                list2.style.background = "white";
            }
        });
    }else{
        list2.style.display = "none";
        list2.style.height = "0px";
        list2.style.background = "white";
    }
}

//列表提交表单方法
function listSubmit2(value){
    //给文本框赋值
    unit.value=value;
    //手动提交表单
    document.getElementById("unit_possible").style.display = "none";
}

//文本框失去焦点处理
function hide(){
    //判断是否需要隐藏，在ul列表中点击鼠标时不能隐藏，隐藏了无法跳转
    if(isHide){
        //隐藏ul列表
        document.getElementById("unit_possible").style.display = "none";
    }
}