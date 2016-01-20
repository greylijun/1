$(document).ready(function(){
	$.getJSON("newquestion.php",function(json){
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
        var td3 = "<ul><li>回复：</li><li><textarea id='answer"+divnum+"' name='answer'></textarea>"
        var td4 = "<input value='提交' readonly class='btn' id='detail"+divnum+"'>"
		var td5 = "<input type='hidden' id='row_id"+divnum+"' value='"+data.row_id+"' name='row_id'></li></ul>"
        var div = td+td1+td2+td3+td4+td5;
        $("#table").append(div);
		detail(divnum);
		divnum++;
	} 
}

function detail(divnum){
    $("#detail"+divnum).click(function(){
		feedback_insert(divnum);
	});
}
function feedback_insert(divnum)
{
    if($("#answer"+divnum).val() == ""){
        sweetAlert("请输入回复！"); 
        
    }else{
		$.post("answer.php",{
            'answer':$("#answer"+divnum).val(),
			'row_id':$("#row_id"+divnum).val(),
        },function(json){
			if(json == ""){
                sweetAlert("提交失败！");
            }else{
                sweetAlert("提交成功！");
				document.execCommand('Refresh') ;   
            }
			
        });
    }
	
}