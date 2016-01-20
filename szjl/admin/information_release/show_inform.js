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
		var td  = "<tr><td><a id="+data.row_id+" title="+data.name+" target='_blank' href='notices/index_inform.php?row_id="+data.row_id+"'>"+data.name+"</a></td><td>"+data.date+"</td>"
		var td1 = "<td><div style='width: 100%; height: 100px; overflow: hidden;'><input style='width: 30px; margin-top:40px;' value='删除' readonly class='btn' id='detail"+divnum+"' ></div> </td></tr>";
        var td2 = "<input type='hidden' id='row_id"+divnum+"' name='row_id' value='"+data.row_id+"' >";
        var div = td+td1+td2;
        $("#mp2_page1").append(div);
		detail(divnum);
		divnum++;
	}    
}
function detail(divnum){
    $("#detail"+divnum).click(function(){
		delete0(divnum);
	});
}
function delete0(divnum)
{
    $.post("delete.php",{
           'row_id':$("#row_id"+divnum).val(),
        },function(json){
			
			if(json == ""){
                alert("删除失败！");
            }else{
                alert("删除成功！");
				document.execCommand('Refresh') ;   
            }
		});
}