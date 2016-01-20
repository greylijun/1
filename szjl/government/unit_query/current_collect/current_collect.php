<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>苏州市用能单位能源计量数据在线采集系统</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../style/style.css">
    <link rel="stylesheet" href="../../../style/sweet-alert.css">
    <style>
        .menu ul li{ width: 33.33%;}
    </style>
</head>
<?php
session_start();
if(!isset($_SESSION['government_tsn'])){
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
                <li><a href="../../main_page/">首页</a></li>
                <li><a href="../../energy_map/">能源地图</a></li>
                <li><a href="../../data_query/">数据查询</a></li>
                <li><a class="active" href="../../unit_query/">单位查询</a></li>
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
                <li><a href="../real_data/real_data.php">实时数据</a></li>
                <li class="on"><a href="../current_collect/current_collect.php">实时采集</a> </li>
            </ul>
        </div>
        <div class="exchange_div">
            <div id="sz_query">
                <div class="bar">
                    <p><a href="../../main_page/inform.php"><img src="../../../image/home.png"> </a><a href="../../unit_query/unit_intro/unit_intro.php">单位查询</a><a>实时采集</a></p>
                    <ul>
                        <li id="equivalent_value"><a>等价值</a></li>
                        <li class="on" id="weight_value"><a>当量值</a></li>
                    </ul>
                </div>
            </div>
            <div class="content">
                <div class="current_collect">
                    <div class="cc_div1">
                        <div class="menu_bar"><img src="../../../image/dq_2.png" style="float: left;"><div id="name1"></div></div>
                        <label id="select1">
                            <ul>
                                <li>
                                    <p>一级表选择：</p>
                                    <select id="table_one_type" onchange="table_change()">
                                    </select>
                                </li>
                                <li>
                                    <p>二级表选择：</p>
                                    <select id="table_two_type" onchange="two_change()">
                                    </select>
                                </li>
                                <li>
                                    <p>三级表选择：</p>
                                    <select id="table_three_type" onchange="three_change()">
                                    </select>
                                </li>
                            </ul>
                        </label>
                        <label id="select2" style="display: none;">
                            <ul>
                                <li>
                                    <p>一级表选择：</p>
                                    <select id="table_one_type2" onchange="table_change2()">
                                    </select>
                                </li>
                                <li>
                                    <p>二级表选择：</p>
                                    <select id="table_two_type2" onchange="two_change2()">
                                    </select>
                                </li>
                                <li>
                                    <p>三级表选择：</p>
                                    <select id="table_three_type2" onchange="three_change2()">
                                    </select>
                                </li>
                            </ul>
                        </label>
                        <div id="current_collect" style="height:220px;"></div>
                    </div>
                    <div class="cc_div2">
                        <div class="menu_bar"><img src="../../../image/dq_3.png" style="float: left;"><div id="name2"></div></div>
                        <div class="table" style="border: none; margin: 0;">
                            <table style="width: 100%;">
                                <tr>
                                    <td>资源类型</td>
                                    <td class="ynl">当量值/吨标煤</td>
                                    <td>占消耗总量百分比</td>
                                </tr>
                                <tr>
                                    <td>水</td>
                                    <td id="current0"></td>
                                    <td id="percent0"></td>
                                </tr>
                                <tr>
                                    <td>电</td>
                                    <td id="current1"></td>
                                    <td id="percent1"></td>
                                </tr>
                                <tr>
                                    <td>煤</td>
                                    <td id="current2"></td>
                                    <td id="percent2"></td>
                                </tr>
                                <tr>
                                    <td>油</td>
                                    <td id="current3"></td>
                                    <td id="percent3"></td>
                                </tr>
                                <tr>
                                    <td>蒸汽</td>
                                    <td id="current4"></td>
                                    <td id="percent4"></td>
                                </tr>
                                <tr>
                                    <td>天然气</td>
                                    <td id="current5"></td>
                                    <td id="percent5"></td>
                                </tr>
                                <tr>
                                    <td>冷量</td>
                                    <td id="current6"></td>
                                    <td id="percent6"></td>
                                </tr>
                                <tr>
                                    <td>能源总量</td>
                                    <td id="current7"></td>
                                    <td id="percent7"></td>
                                </tr>
                                <tr>
                                    <td>资源总量</td>
                                    <td id="current8"></td>
                                    <td id="percent8"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="cc_div3">
                        <div class="menu_bar"><img src="../../../image/dq_4.png" style="float: left;"><div id="name3"></div></div>
                        <div class="table" style="border: none; margin: 0;">
                            <table style="width: 100%;">
                                <tr>
                                    <td>资源类型</td>
                                    <td class="ynl">当量值/吨标煤</td>
                                    <td>占消耗总量百分比</td>
                                </tr>
                                <tr>
                                    <td>水</td>
                                    <td id="energy0">1000</td>
                                    <td id="energy_per0">10%</td>
                                </tr>
                                <tr>
                                    <td>电</td>
                                    <td id="energy1">1000</td>
                                    <td id="energy_per1">10%</td>
                                </tr>
                                <tr>
                                    <td>煤</td>
                                    <td id="energy2">1000</td>
                                    <td id="energy_per2">10%</td>
                                </tr>
                                <tr>
                                    <td>油</td>
                                    <td id="energy3">1000</td>
                                    <td id="energy_per3">10%</td>
                                </tr>
                                <tr>
                                    <td>蒸汽</td>
                                    <td id="energy4">1000</td>
                                    <td id="energy_per4">10%</td>
                                </tr>
                                <tr>
                                    <td>天然气</td>
                                    <td id="energy5">1000</td>
                                    <td id="energy_per5">10%</td>
                                </tr>
                                <tr>
                                    <td>冷量</td>
                                    <td id="energy6">1000</td>
                                    <td id="energy_per6">10%</td>
                                </tr>
                                <tr>
                                    <td>能源总量</td>
                                    <td id="energy7">1000</td>
                                    <td id="energy_per7">10%</td>
                                </tr>
                                <tr>
                                    <td>资源总量</td>
                                    <td id="energy8">1000</td>
                                    <td id="energy_per8">10%</td>
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
<script src="../../../js/highstock.js"></script>
<script src="../../../js/sweet-alert.min.js"></script>
<script src="../../../js/logOut.js"></script>
<script src="current_collect.js"></script>
<script src="../../../js/account.js"></script>
</body>
</html>
