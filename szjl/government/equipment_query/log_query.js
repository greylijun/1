/**
 * Created by LiJun on 2015/11/17.
 */
$(document).ready(function(){
    $("#query_table").append("<tr><td>模块编号</td><td>器具名称</td><td>型号</td><td>单位名称</td><td>最后响应时间</td><td>恢复响应时间</td><td>是否恢复</td></tr>");
   $.getJSON("detail_query/query_condition.php",{
       'area':$("#region").val(),
       'industry':$("#industry_type").val()
   },function(json){
       $("#unit_name").append("<option value='所有企业'>所有企业</option>");
       for(var i =0;i<json.length;i++){
           var data = json[i];
           $("#unit_name").append("<option value='"+data+"'>"+data+"</option>");
       }
   });
    $("#region").change(function(){
        $.getJSON("detail_query/query_condition.php",{
            'area':$("#region").val(),
            'industry':$("#industry_type").val()
        },function(json){
            $("#unit_name").empty();
            $("#unit_name").append("<option value='所有企业'>所有企业</option>");
            for(var i =0;i<json.length;i++){
                var data = json[i];
                $("#unit_name").append("<option value='"+data+"'>"+data+"</option>");
            }
        });
    });
    $("#industry_type").change(function(){
        $.getJSON("detail_query/query_condition.php",{
            'area':$("#region").val(),
            'industry':$("#industry_type").val()
        },function(json){
            $("#unit_name").empty();
            $("#unit_name").append("<option value='所有企业'>所有企业</option>");
            for(var i =0;i<json.length;i++){
                var data = json[i];
                $("#unit_name").append("<option value='"+data+"'>"+data+"</option>");
            }
        });
    });
    //查询设备日志
    $("#query").click(function(){
        $.getJSON("equipment_log.php",{
            'region':$("#region").val(),
            'industry_type':$("#industry_type").val(),
            'unit_name':$("#unit_name").val(),
            'start_time':$("#start_time").val(),
            'end_time':$("#end_time").val(),
            'if_fixed':$("#if_fixed").val()
        },function(json){
            if(json == ""){
                $("#query_table").empty();
                $("#query_table").append("<tr><td>模块编号</td><td>器具名称</td><td>型号</td><td>单位名称</td><td>最后响应时间</td><td>恢复响应时间</td><td>是否恢复</td></tr>");
                sweetAlert("当前状态无设备相关日志！");
            }else{
                showquery(json);
                $("div.page").jPages({
                    containerID:"query",
                    previous:"上一页",
                    next:"下一页",
                    first:"第一页",
                    last:"最后一页",
                    perPage:8,
                    delay:10
                });
            }
        })
    });
    //查询设备实时情况
    $("#real_time_query").click(function(){
        $.getJSON("real_time_query.php",{
            'region':$("#region").val(),
            'industry_type':$("#industry_type").val(),
            'unit_name':$("#unit_name").val()
        },function(json){
            if(json == ""){
                $("#query_table").empty();
                $("#query_table").append("<tr><td>单位名称</td><td>地区类型</td><td>模块编号</td><td>表的等级</td><td>模块状态</td></tr>");
                sweetAlert("无设备实时状态！");
            }else{
                showreal_time_query(json);
                $("div.page").jPages({
                    containerID:"query",
                    previous:"上一页",
                    next:"下一页",
                    first:"第一页",
                    last:"最后一页",
                    perPage:8,
                    delay:10
                });
            }
        })
    })
});

//查询设备日志
function showquery(json){
    $("#query_table").empty();
    $("#query_table").append("<tr><td>模块编号</td><td>器具名称</td><td>型号</td><td>单位名称</td><td>最后响应时间</td><td>恢复响应时间</td><td>是否恢复</td></tr>");
    for(var i =0;i<json.length;i++){
        data = json[i];
        $("#query_table").append("<tr><td>"+data.path_number+"</td><td>"+data.instrument_name+"</td><td>"+data.model_num+"</td><td>"+data.name+"</td><td>"+data.failure_time+"</td><td>"+data.recovery_time+"</td><td>"+data.fixed+"</td></tr>");
    }
}

//查询设备实时情况
function showreal_time_query(json) {
    $("#query_table").empty();
    $("#query_table").append("<tr><td>单位名称</td><td>地区类型</td><td>模块编号</td><td>表的等级</td><td>模块状态</td></tr>");
    for (var i = 0; i < json.length; i++) {
        data = json[i];
        $("#query_table").append("<tr><td>" + data.name + "</td><td>" + data.point_region + "</td><td>" + data.path_number + "</td><td>" + data.grade_table + "</td><td>" + data.point_state + "</td></tr>");
    }
}
