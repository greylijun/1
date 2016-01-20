/**
 * Created by LiJun on 2015/11/19.
 */
$(document).ready(function(){
    $.getJSON("year_select.php",function(json){
        showyear(json);
    });
    $.getJSON("query_condition.php",{
        'area':"全市",
        'industry':"全行业"
    },function(json){
        showEnterName(json);
    });
    $("#area").change(function(){
        $.getJSON("query_condition.php",{
            'area':$("#area").val(),
            'industry':$("#industry").val()
        },function(json){
            $("#key").empty();
            showEnterName(json);
        });
    });
    $("#industry").change(function(){
        $.getJSON("query_condition.php",{
            'area':$("#area").val(),
            'industry':$("#industry").val()
        },function(json){
            $("#key").empty();
            showEnterName(json);
        });
    });
    $("#query").click(function(){
        $.getJSON("energy_consumption.php",{
            'area':$("#area").val(),
            'industry':$("#industry").val(),
            'key':$("#key").val(),
            'year':$("#year").val()
        },function(json){
            if(json == ""){
                $("#limit_query").empty();
                sweetAlert("当前状态无限额相关信息！")
            }else{
                showtable(json);
                $("div.page").jPages({
                    containerID:"limit_query",
                    previous:"上一页",
                    next:"下一页",
                    first:"第一页",
                    last:"最后一页",
                    perPage:10,
                    delay:10
                });
            }
        })
    });
});

//年份选择框
function showyear(json){
    $("#year").append("<option>全部</option>");
    for(var i =0;i<json.length;i++){
        $("#year").append("<option>"+json[i]+"</option>");
    }
}

function  showEnterName(json){
    $("#key").append("<option>所有企业</option>");
    for(var i=0;i<json.length;i++){
        $("#key").append("<option>"+json[i]+"</option>");
    }
}

function showtable(json){
    $("#limit_query").empty();
    var divnum = 1;
    for(var i=0;i<json.length;i++){
        var data = json[i];
        var beyond_equ = data.year_equival_value-data.energy_eqival_limit;
        var beyond_indiff = data.year_indiff_value-data.energy_indiff_limit;
        var source_indiff = data.year_source_indiff_value-data.source_indiff_limit;
        $("#limit_query").append("<tr><td>"+divnum+"</td><td>"+data.name+"</td><td>"+data.limit_year+"</td><td>"+data.energy_eqival_limit+"</td><td>"+data.year_equival_value+"</td><td>"+beyond_equ.toFixed(3)+"</td><td>"+data.energy_indiff_limit+"</td><td>"+data.year_indiff_value+"</td><td>"+beyond_indiff.toFixed(3)+"</td><td>"+data.source_indiff_limit+"</td><td>"+data.year_source_indiff_value+"</td><td>"+source_indiff.toFixed(3)+"</td></tr>");
        divnum++;
    }
}

