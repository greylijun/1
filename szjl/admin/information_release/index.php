<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>苏州市用能单位能源计量数据在线采集系统</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../style/admin.css">
    <link rel="stylesheet" href="../../style/sweet-alert.css">
    <style>
        .menu ul li{ width: 50%;}
        .menu ul li.on a::after{margin-left: -80px;}
    </style>
</head>
<?php
session_start();
if(!isset($_SESSION['admin_tsn'])){
    echo "<script>alert('请登录！');location.href='../../index.php'</script>";
}
?>
<body>
<div class="bg">
    <header role="banner">
        <label>
            <p><img src="../../image/logo.png"/>苏州市用能单位能源计量数据在线采集系统</p>
            <a onclick="logOut1()">退出</a>
            <div class="dropdown">
                <a class="account">
                    <span>管理员</span>
                </a>
                <div class="submenu" style="display: none">
                    <ul class="root">
                        <li><a href="../../password/pwd_reset.php">修改密码</a> </li>
                    </ul>
                </div>
            </div>
        </label>
        <nav>
            <ul>
                <li><a href="../information_check/">信息审核</a></li>
                <li><a class="active" href="../information_release/">信息发布</a></li>
                <li><a href="../view_communication/">意见交流</a></li>
                <li><a href="../data_revise/">数据修正</a></li>
                <li><a href="../site_operation/">现场施工</a></li>
            </ul>
        </nav>
    </header>

    <main role="main">
        <div class="menu">
            <ul>
                <li class="on"><a href="index.php">平台通知（预览）</a></li>
                <li><a href="inform.php">平台通知（发布）</a></li>
            </ul>
        </div>
        <div class="exchange_div">
            <div class="bar">
                <p><a href="../information_check/"><img src="../../image/home.png"> </a><a href="../information_release/">信息发布</a><a>平台通知（预览）</a></p>
            </div>
            <div class="content">

                <div id="focus_Box">
                    <span class="prev">&nbsp;</span>
                    <span class="next">&nbsp;</span>
                    <ul>
                        <li>
                            <a href="#"><img  height="308" alt="Photo sharing jq22" src="../../image/a1.jpg" /></a>
                        </li>
                        <li>
                            <a href="#"><img  height="308" alt="Photo sharing jq22" src="../../image/a6.jpg" /></a>
                        </li>
                        <li>
                            <a href="#"><img  height="308" alt="Photo sharing jq22" src="../../image/a3.jpg" /></a>
                        </li>
                        <li>
                            <a href="#"><img  height="308" alt="Photo sharing" src="../../image/a4.jpg" /></a>
                        <li>
                            <a href="#"><img  height="308" alt="Photo sharing jq22" src="../../image/a7.jpg" /></a>
                        </li>
                    </ul>
                </div>
                <table class="tab"  style="height: 220px;" >
                <tbody id="mp2_page1"></tbody>
                </table>
                <div class="page">
                </div>
            </div>
        </div>
    </main>

    <footer role="contentinfo">
        <div class="friend_link">
            <p>友情链接</p>
            <table>
                <tr>
                    <td><a href="http://www.szjl.com.cn/">苏州市企业二氧化碳排放计量与数据管理平台</a></td>
                    <td><a href="http://www.szjl.com.cn/">苏州市企业计量管理信息化服务平台</a></td>
                    <td><a href="http://www.szjl.com.cn/">苏州市住居商业环境用报警设备测试服务平台</a></td>
                </tr>
                <tr>
                    <td><a href="http://www.szjl.com.cn/">苏州市数字通信类仪器计量检测公共服务平台</a></td>
                    <td><a href="http://www.szjl.com.cn/">苏州市测绘仪器测试服务中心</a></td>
                    <td><a href="http://www.szjl.com.cn/">苏州市生物医药设备验证技术公共服务平台</a></td>
                </tr>
            </table>
        </div>
        <div class="copyright">
            <p>Copyright &copy; 2015 苏州市计量测试研究所版权所有</p>
            <p>联系电话：0512-65230840</p>
        </div>
    </footer>
</div>
<script src="../../js/jquery-1.11.1.min.js"></script>
<script src="../../js/sweet-alert.min.js"></script>
<script src="../../js/logOut.js"></script>
<script src="../../js/jPages.js"></script>
<script src="../../js/highcharts.js"></script>
<script src="../../js/ZoomPic.js"></script>
<script src="information_release.js"></script>
<script src="../../js/account.js"></script>
<script src="show_inform.js"></script>

</body>
</html>
