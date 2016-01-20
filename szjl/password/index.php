<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>苏州市用能单位能源计量数据在线采集系统</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style/style.css">
    <style>
        header{height: 55px;}
    </style>
</head>
<body>
<header role="banner">
    <label>
        <p><img src="../image/logo.png"/>苏州市用能单位能源计量数据在线采集系统</p>
        <p>&nbsp;</p>
    </label>
</header>
<div class="password">
    <ul>
        <li>
            <a class="active" id="pwd1">忘记密码</a>
        </li>
        <li>
            <a id="pwd2">修改密码</a>
        </li>
    </ul>
    <div id="pw1">
        <table>
            <tr>
                <td>登陆名：</td>
                <td><input></td>
            </tr>
            <tr>
                <td>组织机构代码：</td>
                <td><input></td>
            </tr>
            <tr>
                <td>单位联系人：</td>
                <td><input></td>
            </tr>
            <tr>
                <td>联系人号码：</td>
                <td><input></td>
            </tr>
        </table>
        <input type="button" class="btn" value="确定" id="pwbtn1" readonly  style="margin-left: 50%;">
    </div>
    <div id="pw2" style="display: none">
        <table>
            <tr>
                <td>新密码：</td>
                <td><input type="password"></td>
            </tr>
            <tr>
                <td>确认新密码：</td>
                <td><input type="password"></td>
            </tr>
        </table>
        <input type="button" class="btn" value="确定" id="pwbtn2" readonly  style="margin-left: 50%;" >
    </div>

</div>
</body>
<script src="../js/jquery-1.11.1.min.js"></script>
<script src="password.js"></script>
</html>
