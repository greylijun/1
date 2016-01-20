$("#submit").click(function(){
	if($("#register_name").val()==""){
		alert("请输入用户名！");
		return false;
	}
	if($("#register_pwd").val()==""){
		alert("请输入密码！");
		return false;
	}
	if($("#register_pwd_repeat").val()==""){
		alert("请确认密码！");
		return false;
	}
	if($("#register_pwd").val() != $("#register_pwd_repeat").val()){
		alert("确认密码与原密码不一致，请重新填写！");
		return false;
	}
	$.post(
		"register/register.php",
		{user_name:$("#register_name").val(),user_pwd:$("#register_pwd").val()},function(data){
			if(data=="10000"){
				//alert("1234");
				alert("注册成功，请登录完善企业信息！");
				location.href='#';
			}else{
				alert("注册失败，请重新注册！");
			}
		}
	)
}) 