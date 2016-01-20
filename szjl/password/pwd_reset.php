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
        .password{background: url("../image/pwd.png") no-repeat top center #fff;}
        .password #pw1 table tr td span{ width:100%; display: block; font-size:14px; color:#999;}
        .password #pw1{ width:600px; margin: 0 auto; background: #f5fbff; height:500px;}
    </style>
</head>
<body>
<header role="banner">
    <label>
        <p><img src="../image/logo.png"/>苏州市用能单位能源计量数据在线采集系统</p>
        <a onclick="logOut1()">退出</a>
        <div class="dropdown">
            <a class="account">
                <span>吴先生</span>
            </a>
            <div class="submenu" style="display: none">
                <ul class="root">
                    <li><a href="pwd_reset.php">修改密码</a> </li>
                </ul>
            </div>
        </div>
    </label>
</header>
<div class="password">
    <div id="pw1">
        <table>
            <tr>
                <td>原密码：</td>
                <td><input type="password"></td>
            </tr>
            <tr>
                <td>新密码：</td>
                <td>
                    <input type="password">
                    <span>6-20位，请注意区分大小写</span>
                </td>
            </tr>
            <tr>
                <td>确认密码：</td>
                <td>
                    <input type="password">
                    <span>6-20位，请注意区分大小写</span>
                </td>
            </tr>
        </table>
        <input type="button" class="btn" value="确定" readonly  style="margin-left: 45%;">
    </div>
</div>
</body>
<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/account.js"></script>
<script src="password.js"></script>
</html>
