<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>苏州市用能单位能源计量数据在线采集系统</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/sweet-alert.css">
    <style>
        .menu ul li.on a::after{margin-left:-50px;}
        .table>tbody:first-child tr:first-child{height: 40px;}
        .table tr{ height: 29px;}
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
                <li><a class="active" href="../main_page/">首页</a></li>
                <li><a href="../energy_map/">能源地图</a></li>
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
                <li class="on"><a href="index.php">总耗与单耗</a> </li>
                <li><a href="inform.php">平台通知</a></li>
                <li><a href="rules.php">政策法规</a></li>
                <li><a href="saving_actions.php">节能措施</a></li>
            </ul>
        </div>
        <div class="exchange_div">
            <div id="mp_1">
                <div class="bar">
                    <p><a href="../main_page/"><img src="../../image/home.png"> </a><a href="../main_page/">首页</a><a>总耗与单耗</a></p>
                    <ul>
                        <li id="equivalent_value"><a>等价值</a></li>
                        <li class="on" id="weight_value"><a>当量值</a></li>
                    </ul>
                </div>
                <div class="content" style="background: #eeeeee;">
                    <div class="main2">
                        <div class="menu_bar"><img src="../../image/main2_bar.png" style="float: left;"><?php $year=date('Y'); echo "$year";?>年苏州市综合能耗图</div>
                        <div id="container" style="width: 100%; height: 320px;"></div>
                    </div>
                    <div class="main3">
                        <ul>
                            <li>用能单位总数：</li>
                            <li><input id="unit_num" value="" readonly="true">个</li>
                            <li>采集点总数：</li>
                            <li><input id="point_num" value="" readonly="true">个</li>
                            <li id="yesterday_total">上一日综合能耗当量值：</li>
                            <li><input id="energy" value="" readonly="true">tce</li>
                        </ul>
                    </div>
                    <div  class="main4">
                        <div class="table" style="border: none; margin: 0">
                            <table style="width: 100%;">
                                <td>月份</td><td>一月</td><td>二月</td><td>三月</td><td>四月</td><td>五月</td><td>六月</td><td>七月</td><td>八月</td><td>九月</td><td>十月</td><td>十一月</td><td>十二月</td></tr>
                                <tbody id="energy_table"></tbody>
                            </table>
                        </div>
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
<script src="../../js/jquery-1.11.1.min.js"></script>
<script src="../../js/highcharts.js"></script>
<script src="../../js/sweet-alert.min.js"></script>
<script src="../../js/logOut.js"></script>
<script src="main_page.js"></script>
<script src="../../js/account.js"></script>
</body>
</html>
