$(document).ready(function(){
	$.getJSON("history.php",function(json){
        showtable(json);
        showtext(json);
		$("div.page").jPages({
                   containerID:"table",
                   previous:"上一页",
                   next:"下一页",
                   first:"第一页",
                   last:"最后一页",
                   perPage:6,
                   delay:5
               });
    });
});
function showtext(json){
    var p = "<p>"+json.about_enter+"</p>";
    $("#about_enter").append(p);
}

function showtable(json){
    $("#table").empty();
	var divnum = 1;
	for(var i = 0;i<json.length;i++){
		var data = json[i];
		var td  = "<ul><li>苏州市计量测试研究所："+data.sub_time+"</li>";
        var td1 = "<li>主题："+data.theme+"</li>"
		var td2 = "<li>正文："+data.sub_question+"</li></ul>";
        /*var td3 = "<ul><li>回复:"+data.Upd_date+"</li><li><textarea id='answer"+divnum+"' name='answer' >"+data.sub_answer+"</textarea>";*/
	    var td3 = "<ul><li>回复:"+data.Upd_date+"</li><li>"+data.sub_answer+"";
        var td4 = "<input type='hidden' id='row_id"+divnum+"' value='"+data.row_id+"' name='row_id'></li></ul>"
        var div = td+td1+td2+td3+td4;
        $("#table").append(div);
		divnum++;
	}    
		
}