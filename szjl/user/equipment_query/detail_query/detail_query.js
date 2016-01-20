/**
 * Created by LiJun on 2015/11/13.
 */
$(document).ready(function(){
    $.getJSON("query_condition.php",function(json){
        var data=json[0];
        $("#enter_name").val(data);
    });
    $.getJSON("point_select.php",function(json){
        $("#table_id").append("<option>全部</option>");
        for(var i = 0;i<json.length;i++){
            var data1 =json[i];
            $("#table_id").append("<option>"+data1+"</option>");
        }
    });
    $("#query").click(function(){
        $.getJSON("query.php",{
            'enter_name':$("#enter_name").val(),
            'table_id':$("#table_id").val(),
            'source_type':$("#source_type").val()
        },function(json){
            if(json == ""){
                $('#query_table').empty();
                sweetAlert("当前状态不存在采集点明细情况！");
            }else{
                showtable(json);
                $("div.page").jPages({
                    containerID:"query",
                    previous:"上一页",
                    next:"下一页",
                    first:"第一页",
                    last:"最后一页",
                    perPage:10,
                    delay:10
                });
            }
        });
    });
});

function showtable(json){
    $('#query_table').empty();
    var divnum =1;
    for(var i= 0;i<json.length;i++){
        var data = json[i];
        var newdiv = createtable(divnum++,data.point_num,data.source_type,data.grade_table,data.equ_fold,data.equ_discount,data.energy_unit);
        $("#query_table").append(newdiv);
    }
}

function createtable(id,point_num,source_type,grade_table,equ_fold,equ_discount,energy_unit,readonly){
    var tr = $('<tr>');
    tr.append(createTD(''+id,'',id,readonly));
    tr.append(createTD('point_num'+id,'',point_num,readonly));
    tr.append(createTD('source_type'+id,'',source_type,readonly));
    tr.append(createTD('grade_table'+id,'',grade_table,readonly));
    tr.append(createTD('equ_fold'+id+'energy_unit','',equ_fold+energy_unit,readonly));
    tr.append(createTD('equ_discount'+id+'energy_unit','',equ_discount+energy_unit,readonly));
    return tr;
}