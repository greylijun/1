/**
 * Created by LiJun on 2015/11/17.
 */
$(document).ready(function(){
    showlimit();
    $("#submit").click(function(){
        $.getJSON("check_state.php",function(json){
            if(json == "8006"){
                sweetAlert("当前企业存在未审核数据，请等待上次提交的数据审核后再提交！");
            }else{
                savelimit();
            }
        })
    });
});

function limit_data(){
    var water_energy_consumption = $("#water_energy_consumption").val();
    var water_energy_consumption_unit = $("#water_energy_consumption_unit").val();
    var limit_production = $("#water_production").val();
    var limit_production_unit = $("#water_production_unit").val();
    var unit_pro = water_energy_consumption/limit_production;
    $("#water_energy_con_unit_pro").attr("value",unit_pro);
    $("#water_energy_con_unit_pro_unit").attr("value",water_energy_consumption_unit+"/"+limit_production_unit);
    $("#water_revise_limit_value_unit").attr("value",water_energy_consumption_unit+"/"+limit_production_unit);
}

function verify(){
    if(!isNotNULL('water_limit_num','编号')){
        var number = $('#water_limit_num').val();
        $.getJSON("energy_consumption.php",{
            'serial_num':number
        },function(json){
            var data = json[0];
            $("#water_category_name").attr("value",data.category_name);
            $("#water_limit_value").attr("value",data.fixed_value);
            $("#water_limit_value_unit").attr("value",data.fixed_unit);
        });
    }
}

function limit_data2(){
    var energy_consumption = $("#energy_consumption").val();
    var energy_consumption_unit = $("#energy_consumption_unit").val();
    var production = $("#production").val();
    var production_unit = $("#production_unit").val();
    var limit_unit_pro = energy_consumption/production;
    $("#energy_con_unit_pro").attr("value",limit_unit_pro);
    $("#energy_con_unit_pro_unit").attr("value",energy_consumption_unit+"/"+production_unit);
    $("#revise_limit_value_unit").attr("value",energy_consumption_unit+"/"+production_unit);
}

function verify2(){
    var number = $('#limit_num').val();
    if(!isNotNULL('limit_num',"编号")){
        $.getJSON("energy_consumption.php",{
            'serial_num':number
        },function(json){
            var data = json[0];
            $("#category_name").attr("value",data.category_name);
            $("#limit_value").attr("value",data.fixed_value);
            $("#limit_value_unit").attr("value",data.fixed_unit);
        });
    }
}

function showlimit(){
    $.getJSON("display_limit.php",function(json){
        $("#water_energy_consumption").val(json.water_energy_consumption);
        $("#water_energy_consumption_unit").val(json.water_energy_con_unit);
        $("#water_production").val(json.water_production);
        $("#water_production_unit").val(json.water_production_unit);
        $("#water_energy_con_unit_pro").attr('value',json.water_energy_con_unit_pro);
        $("#water_energy_con_unit_pro_unit").attr('value',json.water_energy_con_unit_pro_unit);
        $("#water_limit_num").attr('value',json.water_limit_num);
        $("#water_category_name").attr('value',json.water_category_name);
        $("#water_limit_value").attr('value',json.water_limit_value);
        $("#water_limit_value_unit").attr('value',json.water_limit_value_unit);
        $("#water_revise_limit_value").attr('value',json.water_revise_limit_value);
        $("#water_revise_limit_value_unit").attr('value',json.water_revise_limit_value_unit);
        $("#energy_consumption").attr('value',json.energy_consumption);
        $("#energy_consumption_unit").attr('value',json.energy_con_unit);
        $("#production").attr('value',json.production);
        $("#production_unit").attr('value',json.production_unit);
        $("#energy_con_unit_pro").attr('value',json.energy_con_unit_pro);
        $("#energy_con_unit_pro_unit").attr('value',json.energy_con_unit_pro_unit);
        $("#limit_num").attr('value',json.limit_num);
        $("#category_name").attr('value',json.category_name);
        $("#limit_value").attr('value',json.limit_value);
        $("#limit_value_unit").attr('value',json.limit_value_unit);
        $("#revise_limit_value").attr('value',json.revise_limit_value);
        $("#revise_limit_value_unit").attr('value',json.revise_limit_value_unit);
    });
}

function savelimit(){
    if(!isNotNULL("water_energy_consumption","综合能耗") && !isNotNULL("water_energy_consumption_unit","综合能耗单位") && !isNotNULL("water_production","产量") && !isNotNULL("water_production_unit","产量单位")  && !isNotNULL("energy_consumption","综合能耗") && !isNotNULL("energy_consumption_unit","综合能耗单位") && !isNotNULL("production","产量") && !isNotNULL("production_unit","产量单位")){
        $.post("insert_limit.php",{
            'water_energy_consumption':$("#water_energy_consumption").val(),
            'water_energy_consumption_unit':$("#water_energy_consumption_unit").val(),
            'water_production':$("#water_production").val(),
            'water_production_unit':$("#water_production_unit").val(),
            'water_energy_con_unit_pro':$("#water_energy_con_unit_pro").val(),
            'water_energy_con_unit_pro_unit':$("#water_energy_con_unit_pro_unit").val(),
            'water_limit_num':$("#water_limit_num").val(),
            'water_category_name':$("#water_category_name").val(),
            'water_limit_value':$("#water_limit_value").val(),
            'water_limit_value_unit':$("#water_limit_value_unit").val(),
            'water_revise_limit_value':$("#water_revise_limit_value").val(),
            'water_revise_limit_value_unit':$("#water_revise_limit_value_unit").val(),
            'energy_consumption':$("#energy_consumption").val(),
            'energy_consumption_unit':$("#energy_consumption_unit").val(),
            'production':$("#production").val(),
            'production_unit':$("#production_unit").val(),
            'energy_con_unit_pro':$("#energy_con_unit_pro").val(),
            'energy_con_unit_pro_unit':$("#energy_con_unit_pro_unit").val(),
            'limit_num':$("#limit_num").val(),
            'category_name':$("#category_name").val(),
            'limit_value':$("#limit_value").val(),
            'limit_value_unit':$("#limit_value_unit").val(),
            'revise_limit_value':$("#revise_limit_value").val(),
            'revise_limit_value_unit':$("#revise_limit_value_unit").val()
        },function(json){
            if(json == "限额录入失败！"){
                sweetAlert("能耗数据插入失败！");
            }else{
                sweetAlert("能耗数据插入成功！");
            }
        });
        //$.post("insert_limit_total.php",function(json){
        //});
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
