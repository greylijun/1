/**
 * Created by LiJun on 2015/11/23.
 */
$(document).ready(function(){
    //企业选择
    $.getJSON("query_condition.php",{
        'area':"全市",
        'industry':"全行业"
    },function(json){
        $("#name").append("<option>所有企业</option>");
        for(var i=0;i<json.length;i++){
            $("#name").append("<option>"+json[i]+"</option>");
        }
    });
    //区域变化对企业的影响
    $("#area").change(function(){
        $.getJSON("query_condition.php",{
            'area':$("#area").val(),
            'industry':$("#industry").val()
        },function(json){
            $("#name").empty();
            $("#name").append("<option>所有企业</option>");
            for(var i=0;i<json.length;i++){
                $("#name").append("<option>"+json[i]+"</option>");
            }
        });
    });
    //行业变化对企业的影响
    $("#industry").change(function(){
        $.getJSON("query_condition.php",{
            'area':$("#area").val(),
            'industry':$("#industry").val()
        },function(json){
            $("#name").empty();
            $("#name").append("<option>所有企业</option>");
            for(var i=0;i<json.length;i++){
                $("#name").append("<option>"+json[i]+"</option>");
            }
        });
    });
    $("#query").click(function(){
       $.getJSON("consumption_query.php",{
           'area':$("#area").val(),
           'industry':$("#industry").val(),
           'name':$("#name").val(),
           'year':$("#year").val(),
           'state':$("#state").val()
       },function(json){
           if(json == ""){
               sweetAlert("当前所选状态不存在限额信息！");
           }else{
               showtable(json);
               $("div.page").jPages({
                   containerID:"limit_table",
                   previous:"上一页",
                   next:"下一页",
                   first:"第一页",
                   last:"最后一页",
                   perPage:7,
                   delay:5
               });
           }
       });
    });
    $("#pass").click(function(){
        pass();
    });
    $("#nopass").click(function(){
        nopass();
    });
});

function showtable(json){
    $("#limit_table").empty();
    var divnum =1;
    for(var i=0;i<json.length;i++){
        var data = json[i];
        var td = "<tr><td><input name='box' type='checkbox' value='"+divnum+"'></td>";
        var td1 = "<td>"+divnum+"</td>";
        var td2 = "<td id='name"+divnum+"'>"+data.enterprise_name+"</td>";
        var td3 = "<td id='year"+divnum+"'>"+data.limit_year+"</td>";
        var td6 = "<td id='import_time"+divnum+"' style='display:none;'>"+data.Crt_date+"</td>";
        var td4 = "<td><input id='water_energy_con"+divnum+"' value='"+data.water_energy_con_unit_pro+"' style='width:60px;' readonly='true'>"+data.water_energy_con_unit_pro_unit+"</td>";

        var td5 = "<td><input id='water_limit_value"+divnum+"' value='"+data.water_limit_value+"' style='width:60px;' readonly='true'>"+data.water_limit_value_unit+"</td>";

        var td7 = "<td><input id='water_revise_limit_value"+divnum+"' value='"+data.water_revise_limit_value+"' style='width:60px;' readonly='true'>"+data.water_revise_limit_value_unit+"</td>";

        var td8 = "<td><input id='water_last_limit"+divnum+"' value='"+data.water_last_limit_value+"' style='width:60px;'><input id='water_last_limit_unit"+divnum+"' value='"+data.water_energy_con_unit_pro_unit+"' style='width:60px;' readonly='true'></td>";

        var td10 = "<td><input id='energy_con"+divnum+"' value='"+data.energy_con_unit_pro+"' style='width:60px;' readonly='true'>"+data.energy_con_unit_pro_unit+"</td>";

        var td11 = "<td><input id='limit_value"+divnum+"' value='"+data.limit_value+"' style='width:60px;' readonly='true'>"+data.limit_value_unit+"</td>";

        var td13 = "<td><input id='revise_limit_value"+divnum+"' value='"+data.revise_limit_value+"' style='width:60px;' readonly='true'>"+data.revise_limit_value_unit+"</td>";

        var td14 = "<td><input id='last_limit"+divnum+"' value='"+data.last_limit_value+"' style='width:60px;'><input id='last_limit_unit"+divnum+"' value='"+data.energy_con_unit_pro_unit+"' style='width:60px;' readonly='true'></td>";
        if(data.limit_select != ""){
            var td16 = "<td>"+data.limit_select+"</td>";
        }else{
            var td16 = "<td><select id='select_state"+divnum+"'><option>以定额值为准</option><option>以填报值为准</option><option>以修改值为准</option></select></td>";
        }
        var td17 = "<td id='state"+divnum+"'>"+data.audit_state+"</td>";
        var td18 = "<td><a id='details"+divnum+"' href='javascript:;' class='zoomIn dialog'>详情</a></td></tr>";
        var newdiv = td+td1+td2+td3+td4+td5+td6+td7+td8+td10+td11+td13+td14+td16+td17+td18;
        $("#limit_table").append(newdiv);
        details(divnum);
        divnum++;
    }
    $(function(){
        var $el = $('.dialog');
        $el.hDialog();
        $el.hDialog({
            title:'记录详情',
            box: '#HBox',
            boxBg: '#eeeeee',
            width: 1000,
            height: 400
        });
    });
}

function pass(){
    var obj = document.getElementsByName("box");
    var id_array = new Array();
    for(var i =0;i<obj.length;i++){
        if(obj[i].checked){
            id_array.push(obj[i].value);
        }
    }
    for(var a=0;a<id_array.length;a++){
        var water_energy_con = $("#water_energy_con"+id_array[a]+"").val();     //水的单位综合能耗
        var water_limit_value = $("#water_limit_value"+id_array[a]+"").val();   //水的定额值
        var water_revise_limit_value = $("#water_revise_limit_value"+id_array[a]+"").val();  //水的填报值
        var water_last_limit = $("#water_last_limit"+id_array[a]+"").val();     //水的修改值
        var energy_con = $("#energy_con"+id_array[a]+"").val();                 //能源的单位综合能耗
        var limit_value = $("#limit_value"+id_array[a]+"").val();               //能源的定额值
        var revise_limit_value = $("#revise_limit_value"+id_array[a]+"").val();  //能源的填报值
        var last_limit = $("#last_limit"+id_array[a]+"").val();                  //能源的修改值
        var select_state = $("#select_state"+id_array[a]+"").val();              //限额选择
        var state = $("#state"+id_array[a]+"").val();                            //审核状态
        switch(select_state){
            case '以定额值为准':
                if( Number(water_energy_con) > Number(water_limit_value)){
                    var water_if_beyond = "是";
                }else{
                    var water_if_beyond = "否";
                }
                if( Number(energy_con) > Number(limit_value)){
                    var if_beyond = "是";
                }else{
                    var if_beyond = "否";
                }
                break;
            case '以填报值为准':
                if( Number(water_energy_con) > Number(water_revise_limit_value)){
                    var water_if_beyond = "是";
                }else{
                    var water_if_beyond = "否";
                }
                if( Number(energy_con) > Number(revise_limit_value)){
                    var if_beyond = "是";
                }else{
                    var if_beyond = "否";
                }
                break;
            case '以修改值为准':
                if( Number(water_energy_con) > Number(water_last_limit)){
                    var water_if_beyond = "是";
                }else{
                    var water_if_beyond = "否";
                }
                if( Number(energy_con) > Number(last_limit)){
                    var if_beyond = "是";
                }else{
                    var if_beyond = "否";
                }
                break;
        }
        if(state != '未审核'){
            sweetAlert("不能对同一数据多次审核，请等待企业提交最新数据后再次审核！");
        }else{
            $.post("limit_revise_pass.php",{
                'date':document.getElementById("import_time"+id_array[a]+"").innerText,
                'name':document.getElementById("name"+id_array[a]+"").innerText,
                'water_last_limit_value':water_last_limit,
                'water_last_limit_value_unit':$("#water_last_limit_unit"+id_array[a]+"").val(),
                'last_limit_value':last_limit,
                'last_limit_value_unit':$("#last_limit_unit"+id_array[a]+"").val(),
                'select_state':select_state,
                'water_if_beyond':water_if_beyond,
                'if_beyond':if_beyond
            },function(json){
                if(json == "数据更新成功！"){
                    sweetAlert("限额审核成功！");
                }else{
                    sweetAlert("限额审核失败！");
                }
            });
        }
    }
}

function nopass(){
    var obj = document.getElementsByName("box");
    var id_array = new Array();
    for(var i =0;i<obj.length;i++){
        if(obj[i].checked){
            id_array.push(obj[i].value);
        }
    }
    for(var a=0;a<id_array.length;a++){
        var water_energy_con = $("#water_energy_con"+id_array[a]+"").val();     //水的单位综合能耗
        var water_limit_value = $("#water_limit_value"+id_array[a]+"").val();   //水的定额值
        var water_revise_limit_value = $("#water_revise_limit_value"+id_array[a]+"").val();  //水的填报值
        var water_last_limit = $("#water_last_limit"+id_array[a]+"").val();     //水的修改值
        var energy_con = $("#energy_con"+id_array[a]+"").val();                 //能源的单位综合能耗
        var limit_value = $("#limit_value"+id_array[a]+"").val();               //能源的定额值
        var revise_limit_value = $("#revise_limit_value"+id_array[a]+"").val();  //能源的填报值
        var last_limit = $("#last_limit"+id_array[a]+"").val();                  //能源的修改值
        var select_state = $("#select_state"+id_array[a]+"").val();              //限额选择
        var state = $("#state"+id_array[a]+"").val();                            //审核状态
        switch(select_state){
            case '以定额值为准':
                if( Number(water_energy_con) > Number(water_limit_value)){
                    var water_if_beyond = "是";
                }else{
                    var water_if_beyond = "否";
                }
                if( Number(energy_con) > Number(limit_value)){
                    var if_beyond = "是";
                }else{
                    var if_beyond = "否";
                }
                break;
            case '以填报值为准':
                if( Number(water_energy_con) > Number(water_revise_limit_value)){
                    var water_if_beyond = "是";
                }else{
                    var water_if_beyond = "否";
                }
                if( Number(energy_con) > Number(revise_limit_value)){
                    var if_beyond = "是";
                }else{
                    var if_beyond = "否";
                }
                break;
            case '以修改值为准':
                if( Number(water_energy_con) > Number(water_last_limit)){
                    var water_if_beyond = "是";
                }else{
                    var water_if_beyond = "否";
                }
                if( Number(energy_con) > Number(last_limit)){
                    var if_beyond = "是";
                }else{
                    var if_beyond = "否";
                }
                break;
        }
        if(state != "未审核"){
            sweetAlert("不能对同一数据多次审核，请等待企业提交最新数据后再次审核！");
        }else{
            $.post("limit_revise_no_pass.php",{
                'date':document.getElementById("import_time"+id_array[a]+"").innerText,
                'name':document.getElementById("name"+id_array[a]+"").innerText,
                'water_last_limit_value':water_last_limit,
                'water_last_limit_value_unit':$("#water_last_limit_unit"+id_array[a]+"").val(),
                'last_limit_value':last_limit,
                'last_limit_value_unit':$("#last_limit_unit"+id_array[a]+"").val(),
                'select_state':select_state,
                'water_if_beyond':water_if_beyond,
                'if_beyond':if_beyond
            },function(json){
                if(json == "数据更新成功！"){
                    sweetAlert("限额审核成功！");
                }else{
                    sweetAlert("限额审核失败！");
                }
            });
        }
    }
}

function details(divnum){
    $("#details"+divnum).click(function(){
        $("#query_table").empty();
        $.getJSON("limit_detail.php",{
            'enter_name':document.getElementById("name"+divnum).innerText
        },function(json){
            for(var i=0;i<json.length;i++){
                var data = json[i];
                $("#query_table").append("<tr><td>"+data.limit_num+"</td><td>"+data.category_name+"</td><td>"+data.limit_fixed_unit+data.unit1+'/'+data.unit2+"</td><td>"+data.production+data.unit2+"</td><td>"+data.limit_sum+data.unit1+"</td></tr>");
            }
            $("#page").jPages({
                containerID:"query_table",
                previous:"上一页",
                next:"下一页",
                first:"第一页",
                last:"最后一页",
                perPage:10,
                delay:5
            });
        });
    });
}

