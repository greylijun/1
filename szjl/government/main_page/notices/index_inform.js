$(document).ready(function(){
	$.getJSON("inform_get.php",function(json){
		
		showtable(json);
		
    });
});
function showtext(json){
    var p = "<p>"+json.about_enter+"</p>";
    $("#about_enter").append(p);
}

function showtable(json){
    $("#inform").empty();
	for(var i = 0;i<json.length;i++){
		var data = json[i];
		
		var td  = "<input type='hidden' id='"+data.row_id+"' value='"+data.row_id+"'>"
	    var td0 = "<h1>"+data.name+"</h1>"
        var td1 = "<h3>发布时间："+data.date+"</h3>"
        var td2 = "<p>"+data.content+"</p>"
		var td3 = "<span>来源："+data.unit+"</span>"
		var div = td+td0+td1+td2+td3;
     $("#inform").append(div);
	}    
}