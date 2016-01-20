$(document).ready(function(){
        $("#submit").click(function(){
		inform_insert();  
		$("input[name='name']").val("");
		$("input[name='date']").val("");
		$("textarea[name='content']").val("");       
		$("input[name='unit']").val("");
		$("input[name='file']").val("");         
    });
});
function inform_insert()
{
    if($("#name").val() == ""){
        alert("请输入通知名称！");
        return;
    }else{
        $.post("inform_insert.php",{
            'name':$("#name").val(),
            'date':$("#date").val(),
            'content':$("#content").val(),
		    'unit':$("#unit").val(),
			'file':$("#file").val(),
        },function(json){
			if(json == ""){
                alert("提交成功！");
            }else{
                alert("提交失败！");
            }
			 
        });
    }
}
