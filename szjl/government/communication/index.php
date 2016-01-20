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
        .menu ul li{ width: 100%;}
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
                <li><a href="../energy_map/">能源地图</a></li>
                <li><a href="../data_query/">数据查询</a></li>
                <li><a href="../unit_query/">单位查询</a></li>
                <li><a href="../equipment_query/">设备查询</a></li>
                <li><a href="../energy_consumption">能耗限额</a></li>
                <li><a class="active" href="../communication/">意见交流</a></li>
                <li><a href="../contact_us/">联系我们</a></li>
            </ul>
        </nav>
    </header>
    <main role="main">
        <div class="menu">
            <ul>
                <li class="on"><a href="index.php">历史意见</a></li>
            </ul>
        </div>
        <div class="exchange_div">
            <div class="bar">
                <p><a href="../main_page/"><img src="../../image/home.png"> </a><a href="index.php">意见交流</a><a>历史意见</a></p>
            </div>
            <div class="content">
                <div class="history">
                    <ul>
                        <li>
                            苏州市计量测试研究所：2015/05/22 12:13:50
                        </li>
                        <li>
                            主题：节能方案
                        </li>
                        <li>
                            正文：能否提供详细的改造节能方案
                        </li>
                    </ul>
                    <ul>
                        <li>
                            回复：2015/05/22 13:50:12
                        </li>
                        <li>
                            能否提供详细的节能改造方案需要根据企业的具体情况而定。流程为企业提起需求，平台技术人员去现场进行实地勘察并结合历史耗电量数据，分析之后给出可行的方案
                        </li>
                    </ul>
                    <ul>
                        <li>
                            苏州市计量测试研究所：2015/05/23 12:13:50
                        </li>
                        <li>
                            主题：平台优点
                        </li>
                        <li>
                            正文：接入平台后能否可以给企业带来好处？
                        </li>
                    </ul>
                    <ul>
                        <li>
                            回复：2015/03/23 13:50:12
                        </li>
                        <li>
                            答案是肯定的。平台将提供一系列有用的工具，来帮助企业对自身的能源利用情况做统计分析。具备一定知识的企业管理人员可以进行企业的自我调节从而达到优化生产的目的
                        </li>
                    </ul>
                    <ul>
                        <li>
                            苏州市计量测试研究所：2015/03/26 12:13:50
                        </li>
                        <li>
                            主题：特殊的统计要求
                        </li>
                        <li>
                            正文：我们有一些特殊的统计要求，能否通过该平台进行处理？
                        </li>
                    </ul>
                    <ul>
                        <li>
                            回复：2015/05/26 13:50:12
                        </li>
                        <li>
                            可以。需要向平台建设方提出申请，平台方会给出具体的网络接口和协议，供读取数据使用。
                        </li>
                    </ul>
                    <div class="page"></div>
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
<script src="../../js/account.js"></script>
<script src="../../js/sweet-alert.min.js"></script>
<script src="../../js/logOut.js"></script>
</body>
</html>
