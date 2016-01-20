/**
 * Created by zhangliqin on 2015/11/20.
 */
$(document).ready(function(){
    $.getJSON("query_condition.php",{
       'area':"全市"
    },function (json){
        $("#unit_name").append("<option>所有企业</option>");
        for(var i = 0;i<json.length;i++){
            $("#unit_name").append("<option>"+json[i]+"</option>");
        }
    });
    $("#area").change(function(){
        $.getJSON("query_condition.php",{
            'area':$("#area").val()
        },function(json){
            $("#unit_name").empty();
            $("#unit_name").append("<option>所有企业</option>");
            for(var i= 0;i<json.length;i++){
                $("#unit_name").append("<option>"+json[i]+"</option>");
            }
        });
    });
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
            $("#query_table").empty();
            show_day_table();
        }
        if($("#revise_type").val() == "月数据修正"){
            $("#query_table").empty();
            show_month_table();
        }
    });
});

function show_day_table(){
    $.getJSON("revise_record.php",{
        'unit_name':$("#unit_name").val(),
        'area':$("#area").val(),
        'energy_type':$("#energy_type").val(),
        'revise_type':$("#revise_type").val(),
        'day_select':$("#day_select").val()
    },function(json){
        if(json == ""){
            sweetAlert("当前状态无修正记录！");
        }else{
            var divnum = 1;
            for(var i=0;i<json.length;i++){
                var data = json[i];
                var tr = "<tr><td>"+divnum+"</td><td>"+data.name+"</td><td>"+data.energy_big_type+"</td><td>"+data.import_time+"</td><td>"+data.Upd_date+"</td><td>"+data.original_equ_data+"</td><td>"+data.original_ind_data+"</td><td>"+data.revise_equ_data+"</td><td>"+data.revise_ind_data+"</td><tr>";
                $("#query_table").append(tr);
                divnum++;
            }
        }
    })
}

function show_month_table(){
    $.getJSON("revise_record.php",{
        'unit_name':$("#unit_name").val(),
        'area':$("#area").val(),
        'energy_type':$("#energy_type").val(),
        'revise_type':$("#revise_type").val(),
        'year_select':$("#year_select").val(),
        'month_select':$("#month_select").val()
    },function(json){
        if(json == ""){
           sweetAlert("当前状态无修正记录！");
        }else{
            var divnum = 1;
            for(var i=0;i<json.length;i++){
                var data = json[i];
                var tr = "<tr><td>"+divnum+"</td><td>"+data.name+"</td><td>"+data.energy_big_type+"</td><td>"+data.import_time+"</td><td>"+data.Upd_date+"</td><td>"+data.original_equ_data+"</td><td>"+data.original_ind_data+"</td><td>"+data.revise_equ_data+"</td><td>"+data.revise_ind_data+"</td><tr>";
                $("#query_table").append(tr);
                divnum++;
            }
        }
    });
}