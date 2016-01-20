<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>苏州市用能单位能源计量数据在线采集系统</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/animate.min.css">
    <link rel="stylesheet" href="style/common.css">
</head>
<body>
<div class="login">
    <div class="enter">
        <ul>
            <li><p>用户类型：</p>
                <select id="user_type">
                    <option>用能单位</option>
                    <option>监管机构</option>
                    <option>政府部门</option>
                    <option>管理员</option>
                </select>
            </li>
            <li>
                <p>登陆方式：</p>
                <select id="login_type">
                    <option>组织机构代码</option>
                    <option>营业执照号</option>
                    <option>联系人手机号</option>
                </select>
            </li>
            <li><p id="login_name">组织机构代码：</p><input id="user_name" type="text"/></li>
            <li><p>用户密码：</p><input id="user_pwd" type="password"/></li>
            <li><p>验证码：</p><input id="authcode" /><img style="cursor:pointer" class="" src="utils/authcode.php" onClick="this.src=this.src+'?'+Math.random();" /></li>
            <li><p>&nbsp;</p><input type="checkbox"/><label>记住密码</label><a href="password/">忘记密码</a></li>
        </ul>
        <label>
            <div style="float: left; width: 50%; height: 50px; display: block;">
                <a id="button" class="btn_login">登陆</a>
            </div>
            <div style="float: left; width: 50%; height: 50px; display: block;">
                <a href="register/detail.php" class="zoomIn btn_login dialog">注册</a>
            </div>
        </label>
    </div>
</div>
</body>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery.hDialog.js"></script>
<script src="register/register.js"></script>
<script src="login/login.js"></script>
</html>
