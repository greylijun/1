/**
 * Created by LiJun on 2015/11/23.
 */
$(document).ready(function(){
    $.getJSON("limit_query.php",function(json){
        if(json == "8007"){
            swal({
                title:"苏州市用能单位能源计量数据在线采集系统",
                text:"该企业限额信息不存在！",
                type:"warning",
                confirmButtonText:"是"
            });
        }else{
            showLimittable(json);
        }
    });
});

function showLimittable(json){
    $("#limit_query").empty();
    var divnum = 1;
    ;
    for(var i =0;i<json.length;i++){
        data = json[i];
        var beyond_equ = data.year_equival_value-data.energy_eqival_limit;
        var beyond_indiff = data.year_indiff_value-data.energy_indiff_limit;
        var source_indiff = data.year_source_indiff_value-data.source_indiff_limit;
        $("#limit_query").append("<tr><td>"+divnum+"</td><td>"+data.name+"</td><td>"+data.year+"</td><td>"+data.energy_eqival_limit+"</td><td>"+data.year_equival_value+"</td><td>"+beyond_equ.toFixed(3)+"</td><td>"+data.energy_indiff_limit+"</td><td>"+data.year_indiff_value+"</td><td>"+beyond_indiff.toFixed(3)+"</td><td>"+data.source_indiff_limit+"</td><td>"+data.year_source_indiff_value+"</td><td>"+source_indiff.toFixed(3)+"</td></tr>");
        divnum++;
    }
}