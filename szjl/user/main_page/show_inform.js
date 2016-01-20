$(document).ready(function(){
	$.getJSON("../../admin/information_release/show_inform.php",function(json){
        showtable(json);
        showtext(json);
		$("div.page").jPages({
			       containerID:"mp2_page1",
                   previous:"上一页",
                   next:"下一页",
                   first:"第一页",
                   last:"最后一页",
                   perPage:2,
                   delay:5
               });
	});
});
function showtext(json){
    var p = "<p>"+json.about_enter+"</p>";
    $("#about_enter").append(p);
}

function showtable(json){
    $("#mp2_page1").empty();
	var divnum = 1;
	for(var i = 0;i<json.length;i++){
		var data = json[i];
		var td  = "<tr><td><a id="+data.row_id+" title="+data.name+" target='_blank' href='notices/index_inform.php?row_id="+data.row_id+"'>"+data.name+"</a></td><td>"+data.date+"</td></tr>";
        var td1 = "<input type='hidden' id='"+data.row_id+"' value='"+data.row_id+"' name='"+data.row_id+"'>";
		 var div = td+td1;
        $("#mp2_page1").append(div);
		divnum++;
	}    
}