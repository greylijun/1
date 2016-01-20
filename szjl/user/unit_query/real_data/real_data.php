<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>苏州市用能单位能源计量数据在线采集系统</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../style/user.css">
    <link rel="stylesheet" href="../../../style/sweet-alert.css">
    <style>
        .menu ul li{ width: 25%;}

    </style>
</head>
<?php
session_start();
if(!isset($_SESSION['enter_tsn'])) {
    echo "<script>alert('请登录！');location.href='../../../index.php'</script>";
}
?>
<body>
<div class="bg">
    <header role="banner">
        <label>
            <p><img src="../../../image/logo.png"/>苏州市用能单位能源计量数据在线采集系统</p>
            <a onclick="logOut()">退出</a>
            <div class="dropdown">
                <a class="account">
                    <span>吴先生</span>
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
                <li><a href="../../main_page/inform.php">首页</a></li>
                <li><a href="../../data_query/">数据查询</a></li>
                <li><a class="active" href="../../unit_query/unit_intro/unit_intro.php">单位查询</a></li>
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
                <li><a href="../unit_intro/unit_intro.php">单位简介</a></li>
                <li class="on"><a href="../real_data/real_data.php">实时数据</a></li>
                <li><a href="../current_collect/current_collect.php">实时采集</a></li>
                <li><a href="../data_entry/data_entry.php">数据录入</a> </li>
            </ul>
        </div>
        <div class="exchange_div">
            <div id="sz_query">
                <div class="bar">
                    <p><a href="../../main_page/inform.php"><img src="../../../image/home.png"> </a><a href="../../unit_query/unit_intro/unit_intro.php">单位查询</a><a>实时数据</a></p>
                    <ul>
                        <li id="equivalent_value"><a>等价值</a></li>
                        <li class="on" id="weight_value"><a>当量值</a></li>
                    </ul>
                </div>
            </div>
            <div class="content">
                <div class="real_data">
                    <div class="rd_div1">
                        <div class="menu_bar"><img src="../../../image/dq_2.png" style="float: left;"><div id="name1"></div></div>
                        <div id="real_data" style="height:265px;"></div>
                    </div>
                    <div class="rd_div3">
                        <div class="menu_bar"><img src="../../../image/dq_4.png" style="float: left;"><div id="name2"></div></div>
                        <div id="pie" style=" margin-top:100px;"></div>
                    </div>
                    <div class="rd_div2">
                        <div class="menu_bar"><img src="../../../image/dq_3.png" style="float: left;"><div id="name3"></div></div>
                        <div class="table" style="border: none; margin: 0;">
                            <table>
                                <tr>
                                    <td>资源类型</td>
                                    <td class="ynl">当量值/吨标煤</td>
                                    <td>占消耗总量百分比</td>
                                </tr>
                                <tr>
                                    <td>水</td>
                                    <td id="real0"></td>
                                    <td id="per0"></td>
                                </tr>
                                <tr>
                                    <td>电</td>
                                    <td id="real1"></td>
                                    <td id="per1"></td>
                                </tr>
                                <tr>
                                    <td>煤</td>
                                    <td id="real2"></td>
                                    <td id="per2"></td>
                                </tr>
                                <tr>
                                    <td>油</td>
                                    <td id="real3"></td>
                                    <td id="per3"></td>
                                </tr>
                                <tr>
                                    <td>蒸汽</td>
                                    <td id="real4"></td>
                                    <td id="per4"></td>
                                </tr>
                                <tr>
                                    <td>天然气</td>
                                    <td id="real5"></td>
                                    <td id="per5"></td>
                                </tr>
                                <tr>
                                    <td>冷量</td>
                                    <td id="real6"></td>
                                    <td id="per6"></td>
                                </tr>
                                <tr>
                                    <td>能源总量</td>
                                    <td id="real7"></td>
                                    <td id="per7"></td>
                                </tr>
                                <tr>
                                    <td>资源总量</td>
                                    <td id="real8"></td>
                                    <td id="per8"></td>
                                </tr>
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
                    <td><a>苏州市企业二氧化碳排放计量与数据管理平台</a></td>
                    <td><a>苏州市企业计量管理信息化服务平台</a></td>
                    <td><a>苏州市住居商业环境用报警设备测试服务平台</a></td>
                </tr>
                <tr>
                    <td><a>苏州市数字通信类仪器计量检测公共服务平台</a></td>
                    <td><a>苏州市测绘仪器测试服务中心</a></td>
                    <td><a>苏州市生物医药设备验证技术公共服务平台</a></td>
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
<script src="../../../js/sweet-alert.min.js"></script>
<script src="../../../js/logOut.js"></script>
<script src="../../../js/highstock.js"></script>
<script src="real_data.js"></script>
<script src="../../../js/account.js"></script>
</body>
</html>
