/**
 * 
 */
$(function(){
    var $el = $('.dialog');
    $el.hDialog();
});

$("#user_type").change(function(){
    if($("#user_type").val() != "用能单位"){
        $("#login_type").empty();
        $("#login_type").append("<option>用户名</option>");
        var name = $("#login_type").val()+"：";
        $("#login_name").text(name);
    }
    if($("#user_type").val() == "用能单位"){
        $("#login_type").empty();
        $("#login_type").append("<option>组织机构代码</option><option>营业执照号</option><option>联系人手机号</option>");
        var name = $("#login_type").val()+"：";
        $("#login_name").text(name);
    }
});

$("#login_type").change(function(){
    var name = $("#login_type").val()+"：";
    $("#login_name").text(name);
});

$("#button").click(function(){
	//alert($("#user_name").val());
	if($("#user_name").val()==""){
		alert("请输入用户名！"); 
		return false;
	}
	else if($("#user_pwd").val()==""){alert("请输入密码！"); return false;}
	else if($("#authcode").val()==""){alert("请输入验证码！"); return false;}
	$.post("login/login.php", {
            user_name:$("#user_name").val(),
		    user_pwd:$("#user_pwd").val(),
            login_type:$("#login_type").val(),
            authcode:$("#authcode").val(),
            user_type:$("#user_type").val()
		 },function(data){
			if(data=="AuthcodeError"){
				alert("验证码错误！");
				return false;
			}else if(data=="UserNameError"){
				alert("用户名或密码错误！");
				return false;
			}else if(data=="UserTypeError"){
				alert("您没有此项权限！");
				return false;
			}else if(data=="TsnError"){
				alert("请完善信息！");
				location.href='register/detail.php';
				//return false;
			}else if(data=="UserError"){
				alert("对不起，您的信息审核未通过！");
				location.href='#';
				//return false;
			}else if(data=="UserWarning"){
				alert("您的信息还未审核，请耐心等待！");
				location.href='#';
				//return false;
			}else if(data=="UserSuccess"){
				location.href='user/main_page/inform.php';
			}else if(data=="SupervisionSuccess"){
				location.href='government/main_page/index.php';
			}else if(data=="AdminSuccess"){
				location.href='admin/information_check/index.php';
			}else if(data=="GovernmentSuccess"){
				location.href='government/main_page/index.php';
			}
		}
	)
})