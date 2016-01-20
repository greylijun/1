/**
 * Created by LiJun on 2015/11/13.
 */
$(document).ready(function(){
    $.getJSON("query_condition.php",{
       'area':$("#area").val(),
       'industry':$("#industry").val()
    },function(json){
        $("#enter_name").append("<option value='所有企业'>所有企业</option>");
        for(var i =0;i<json.length;i++){
            var data=json[i];
            $("#enter_name").append("<option value='"+data+"'>"+data+"</option>");
        }
    });
    $.getJSON("point_select.php",{
        'enter_name':"所有企业"
    },function(json){
        $("#point_number").empty();
        for(var i = 0;i<json.length;i++){
            var data1 =json[i];
            //console.log($("#enter_name").val());
            $("#point_number").append("<li>"+data1+"</li>");
        }
    });
    $("#enter_name").change(function(){
        $.getJSON("point_select.php",{
            'enter_name':$("#enter_name").val()
        },function(json){
            $("#point_number").empty();
            for(var i = 0;i<json.length;i++){
                var data1 =json[i];
                //console.log($("#enter_name").val());
                $("#point_number").append("<li>"+data1+"</li>");
            }
        });
    });
    $("#area").change(function(){
        $.getJSON("query_condition.php",{
            'area':$("#area").val(),
            'industry':$("#industry").val()
        },function(json){
            $("#enter_name").empty();
            for(var i =0;i<json.length;i++){
                var data2=json[i];
                //console.log(json);
                $("#enter_name").append("<option value='"+data2+"'>"+data2+"</option>");
            }
        })
    });
    $("#industry").change(function(){
        $.getJSON("query_condition.php",{
            'area':$("#area").val(),
            'industry':$("#industry").val()
        },function(json){
            $("#enter_name").empty();
            console.log($("#area").val());
            console.log($("#industry").val());
            for(var i =0;i<json.length;i++){
                var data3=json[i];
                //console.log(json);
                $("#enter_name").append("<option value='"+data3+"'>"+data3+"</option>");
            }
        })
    });
    $("#query").click(function(){
        $.getJSON("query.php",{
            'area':$("#area").val(),
            'industry':$("#industry").val(),
            'enter_name':$("#enter_name").val(),
            'table_id':$("#table_id").val(),
            'source_type':$("#source_type").val()
        },function(json){
            if(json == ""){
                $('#query_table').empty();
                sweetAlert("当前状态无相关明细情况！");
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
        })
    });
});

function showtable(json){
    $('#query_table').empty();
    var divnum =1;
    for(var i= 0;i<json.length;i++){
        var data = json[i];
        var newdiv = createtable(divnum++,data.region,data.type,data.name,data.point_num,data.source_type,data.grade_table,data.equ_fold,data.equ_discount,data.energy_unit);
        $("#query_table").append(newdiv);
    }
}

function createtable(id,region,type,name,point_num,source_type,grade_table,equ_fold,equ_discount,energy_unit,readonly){
    var tr = $('<tr>');
    tr.append(createTD(''+id,'',id,readonly));
    tr.append(createTD('region'+id,'',region,readonly));
    tr.append(createTD('type'+id,'',type,readonly));
    tr.append(createTD('name'+id,'',name,readonly));
    tr.append(createTD('point_num'+id,'',point_num,readonly));
    tr.append(createTD('source_type'+id,'',source_type,readonly));
    tr.append(createTD('grade_table'+id,'',grade_table,readonly));
    tr.append(createTD('equ_fold'+id+'energy_unit','',equ_fold+energy_unit,readonly));
    tr.append(createTD('equ_discount'+id+'energy_unit','',equ_discount+energy_unit,readonly));
    return tr;
}