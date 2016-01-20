<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>苏州市用能单位能源计量数据在线采集系统</title>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=EDd02aa85d6e9a5d199e9fd2ae386543"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/library/Heatmap/2.0/src/Heatmap_min.js"></script>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/sweet-alert.css">
    <style>
        .menu ul li{ width: 33.3333%;}
        .menu ul li.on a::after{margin-left: -35px;}
    </style>
</head>
<?php
session_start();
if(!isset($_SESSION['government_tsn'])){
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
                    <span>吴先生</span>
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
                <li><a href="../main_page/">首页</a></li>
                <li><a class="active" href="../energy_map/">能源地图</a></li>
                <li><a href="../data_query/">数据查询</a></li>
                <li><a href="../unit_query/">单位查询</a></li>
                <li><a href="../equipment_query/">设备查询</a></li>
                <li><a href="../energy_consumption">能耗限额</a></li>
                <li><a href="../communication/">意见交流</a> </li>
                <li><a href="../contact_us/">联系我们</a></li>
            </ul>
        </nav>
    </header>
    <main role="main">
        <div class="menu">
            <ul>
                <li><a href="index.php">分布图</a></li>
                <li class="on"><a href="consumption_photo.php">能耗图</a></li>
                <li><a href="user_statics.php">用户分布</a></li>
            </ul>
        </div>
        <div class="exchange_div">
            <div id="em_2">
                <div class="bar">
                    <p><a href="../main_page/"><img src="../../image/home.png"> </a><a href="../energy_map/">能源地图</a><a>能耗图</a></p>
                </div>
                <div class="content">
                    <div class="area">
                        <ul>
                            <li id="a_1" class="active"><a>全市</a></li>
                            <li id="a_2"><a>姑苏区</a></li>
                            <li id="a_3"><a>园区</a></li>
                            <li id="a_4"><a>高新区</a></li>
                            <li id="a_5"><a>吴中区</a></li>
                            <li id="a_6"><a>相城区</a></li>
                            <li id="a_7"><a>吴江区</a></li>
                            <li id="a_8"><a>昆山市</a></li>
                            <li id="a_9"><a>常熟市</a></li>
                            <li id="a_10"><a>张家港</a></li>
                            <li id="a_11"><a>太仓市</a></li>
                        </ul>
                    </div>
                    <div id="energy_consumption" style="height: 500px; width:80%; margin: 10px auto;"></div>
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
<script type="text/javascript" src="../../js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="energy_map.js"></script>
<script type="text/javascript" src="../../js/sweet-alert.min.js"></script>
<script type="text/javascript" src="../../js/logOut.js"></script>
<script src="../../js/account.js"></script>
<script type="text/javascript" src="energy_consumption/suzhou.js"></script>
<script type="text/javascript" src="energy_consumption/gusuqu.js"></script>
<script type="text/javascript" src="energy_consumption/yuanqu.js"></script>
<script type="text/javascript" src="energy_consumption/gaoxinqu.js"></script>
<script type="text/javascript" src="energy_consumption/wuzhongqu.js"></script>
<script type="text/javascript" src="energy_consumption/xiangchengqu.js"></script>
<script type="text/javascript" src="energy_consumption/wujiangqu.js"></script>
<script type="text/javascript" src="energy_consumption/kunshan.js"></script>
<script type="text/javascript" src="energy_consumption/changshu.js"></script>
<script type="text/javascript" src="energy_consumption/zhangjiagang.js"></script>
<script type="text/javascript" src="energy_consumption/taicang.js"></script>
</body>
</html>
