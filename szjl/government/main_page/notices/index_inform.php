<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>平台通知</title>
    <link rel="stylesheet" href="../../../style/style.css">
</head>
<?php
session_start();
$_SESSION['row_id'] = $_GET['row_id'];
?>
<body>
<div class="bg">
    <header role="banner">
        <label>
            <p><img src="../../../image/logo.png"/>苏州市用能单位能源计量数据在线采集系统</p>
            <a onclick="logOut1()">退出</a>
            <div class="dropdown">
                <a class="account">
                    <span>管理员</span>
                </a>
                <div class="submenu" style="display: none">
                    <ul class="root">
                        <li><a href="../../../password/pwd_reset.php">修改密码</a> </li>
                    </ul>
                </div>
            </div>
        </label>
        <nav>
            <ul>
                <li><a class="active" href="../../main_page/">首页</a></li>
                <li><a href="../../energy_map/">能源地图</a></li>
                <li><a href="../../data_query/">数据查询</a></li>
                <li><a href="../../unit_query/">单位查询</a></li>
                <li><a href="../../equipment_query/">设备查询</a></li>
                <li><a href="../../energy_consumption">能耗限额</a></li>
                <li><a href="../../communication/">意见交流</a> </li>
                <li><a href="../../contact_us/">联系我们</a></li>
            </ul>
        </nav>
    </header>

    <main role="main">
        <div class="menu">
            <ul>
                <li><a href="../index.php">总耗与单耗</a></li>
                <li class="on"><a href="../inform.php">平台通知</a></li>
                <li><a href="../rules.php">政策法规</a></li>
                <li><a href="../saving_actions.php">节能措施</a></li>
            </ul>
        </div>
        <div class="exchange_div">
            <div id="mp_2">
                <div class="bar">
                    <p><a href="../../main_page/"><img src="../../../image/home.png"> </a><a href="../../main_page/">首页</a><a href="../inform.php">平台通知</a></p>
                </div>
                <div class="content">
                    <div class="inform" id="inform">
                        
                    </div>
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
<script src="../../../js/jquery-1.11.1.min.js"></script>
<script src="index_inform.js"></script>
<script src="../../../js/account.js"></script>
</body>
</html>
