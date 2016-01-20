<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>苏州市用能单位能源计量数据在线采集系统</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../style/user.css">
    <link rel="stylesheet" href="../../style/sweet-alert.css">
    <style>
        .menu ul li{ width: 33.3333%;}
    </style>
</head>
<?php
session_start();
if(!isset($_SESSION['enter_tsn'])) {
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
                <li><a class="active" href="../main_page/inform.php">首页</a></li>
                <li><a href="../data_query/">数据查询</a></li>
                <li><a href="../unit_query/unit_intro/unit_intro.php">单位查询</a></li>
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
                <li><a href="inform.php">平台通知</a></li>
                <li class="on"><a href="rules.php">政策法规</a></li>
                <li><a href="saving_actions.php">节能措施</a></li>
            </ul>

        </div>
        <div class="exchange_div">
            <div id="mp_3">
                <div class="bar">
                    <p><a href="../main_page/inform.php"><img src="../../image/home.png"> </a><a href="../main_page/inform.php">首页</a><a>政策法规</a></p>
                </div>
                <div class="content">
                    <br/>
                    <div id="mp3_page1">
                        <table class="tab">
                            <tr>
                                <td>GB 17167-2006 用能单位能源计量器具配备和管理通则</td>
                                <td><a href="policies/GB 17167-2006.pdf">【下载】</a></td>
                            </tr>
                            <tr>
                                <td>中华人民共和国节约能源法</td>
                                <td><a href="policies/China energy conservation law (Presidential Decree No. seventy-seventh).html">【下载】</a></td>
                            </tr>
                            <tr>
                                <td>GB 24789-2009 用水单位水计量器具配备和管理通则</td>
                                <td><a href="policies/GB 24789-2009.pdf">【下载】</a></td>
                            </tr>
                            <tr>
                                <td>能源计量监督管理办法</td>
                                <td><a href="policies/Energy Metering Supervision and Administration.html">【下载】</a></td>
                            </tr>
                            <tr>
                                <td>国务院关于印发十二五节能减排综合性工作方案的通知</td>
                                <td><a href="policies/The people's Republic of China energy conservation law.html">【下载】</a></td>
                            </tr>
                            <tr>
                                <td>国务院关于印发十二五控制温室气体排放工作方案的通知</td>
                                <td><a href="policies/Circular of the State Council issued on the Twelfth Five Year work.html">【下载】</a></td>
                            </tr>
                            <tr>
                                <td>发改环资[2011]2873号关于印发万家企业节能低碳行动实施方案的通知</td>
                                <td><a href="policies/Million businesses on the issuance of low-carbon energy.html">【下载】</a></td>
                            </tr>
                            <tr>
                                <td>JJF重点用能单位能源计量审查规范-辅导</td>
                                <td><a href="policies/JJF.pdf">【下载】</a></td>
                            </tr>
                            <tr>
                                <td>国务院关于印发计量发展规划（2013-2020年）的通知</td>
                                <td><a href="policies/Of the State Council on the development plan of issuing measurement (2013-2020) Notice.html">【下载】</a></td>
                            </tr>
                        </table>
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
<script src="../../js/sweet-alert.min.js"></script>
<script src="../../js/logOut.js"></script>
<script src="../../js/highcharts.js"></script>
<script src="../../js/account.js"></script>
<script src="../../js/ZoomPic.js"></script>
</body>
</html>
