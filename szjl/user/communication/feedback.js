$(document).ready(function(){
    $.getJSON("feedback.php",function(json){
        $("#username").attr("value",json.username);
        $("#tel").attr("value",json.tel);
        $("#email").attr("value",json.email);
        showtext(json);
    });
	    $("#submit").click(function(){
        feedback_insert();  
		$("input[name='theme']").val("");
		$("textarea[name='question']").val("");                
    });
});

function showtext(json){
    var p = "<p>"+json.about_enter+"</p>";
    $("#about_enter").append(p);
}
function feedback_insert()
{
    if($("#theme").val() == ""){
        alert("请输入主题！");
        return;
    }else{
        $.post("feedback_insert.php",{
            'theme':$("#theme").val(),
            'question':$("#question").val(),
          
        },function(json){
            if(json == ""){
                alert("提交失败！");
            }else{
                alert("提交成功！");
            }
        });
    }
}
