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
                <li><a href="../main_page/inform.php">首页</a></li>
                <li><a href="../data_query/">数据查询</a></li>
                <li><a href="../unit_query/unit_intro/unit_intro.php">单位查询</a></li>
                <li><a href="../equipment_query/">设备查询</a></li>
                <li><a class="active" href="../energy_consumption">能耗限额</a></li>
                <li><a href="../communication/">意见交流</a> </li>
                <li><a href="../contact_us/">联系我们</a></li>
            </ul>
        </nav>
    </header>
    <main role="main">
        <div class="menu">
            <ul>
                <li class="on"><a href="index.php">限额填报</a> </li>
                <li><a href="consumption_query.php">限额查询</a></li>
                <li><a href="download.php">资料下载</a></li>
            </ul>
        </div>
        <div class="exchange_div">
            <div class="bar">
                <p><a href="../main_page/inform.php"><img src="../../image/home.png"> </a><a href="../energy_consumption/">能耗限额</a><a>限额填报</a></p>
            </div>
            <div class="content" style="background: #eeeeee;">
                <div class="energy_consum">
                    <div class="menu_bar">
                        <img src="../../image/dq_3.png">限额填报
                    </div>
                    <table>
                        <tr>
                            <td>水</td>
                            <td>
                                <ul>
                                    <li>综合能耗</li>
                                    <li>产量</li>
                                    <li>单位产品综合能耗</li>
                                </ul>
                                <ul>
                                    <li><input id="water_energy_consumption" value="" class="bor"><input id="water_energy_consumption_unit" value="" class="bor"></li>
                                    <li><input id="water_production" value="" onblur="limit_data()" class="bor"><input id="water_production_unit" value="" onblur="limit_data()"></li>
                                    <li><input id="water_energy_con_unit_pro" value=""><input id="water_energy_con_unit_pro_unit" value=""></li>
                                </ul>
                                <ul>
                                    <li>编号查询</li>
                                    <li>类别名称</li>
                                    <li>定额值</li>
                                </ul>
                                <ul>
                                    <li><input id="water_limit_num" value="" onblur="verify()" class="bor"></li>
                                    <li><input id="water_category_name" value=""></li>
                                    <li><input id="water_limit_value" value=""><input id="water_limit_value_unit" value=""></li>
                                </ul>
                                <ul>
                                    <li>修改限额值</li>
                                    <li></li>
                                </ul>
                                <ul>
                                    <li><input id="water_revise_limit_value" value="" class="bor"><input id="water_revise_limit_value_unit" value=""></li>
                                    <li></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>能源</td>
                            <td>
                                <ul>
                                    <li>综合能耗</li>
                                    <li>产量</li>
                                    <li>单位产品综合能耗</li>
                                </ul>
                                <ul>
                                    <li><input id="energy_consumption" value="" onblur="limit_data2()"><input id="energy_consumption_unit" value="" onblur="limit_data2()"></li>
                                    <li><input id="production" value="" onblur="limit_data2()"><input id="production_unit" value="" onblur="limit_data2()"></li>
                                    <li><input id="energy_con_unit_pro" value=""><input id="energy_con_unit_pro_unit" value=""></li>
                                </ul>
                                <ul>
                                    <li>编号查询</li>
                                    <li>类别名称</li>
                                    <li>定额值</li>
                                </ul>
                                <ul>
                                    <li><input id="limit_num" value="" onblur="verify2()"></li>
                                    <li><input id="category_name" value=""></li>
                                    <li><input id="limit_value" value=""><input id="limit_value_unit" value=""></li>
                                </ul>
                                <ul>
                                    <li>修改限额值</li>
                                    <li></li>
                                </ul>
                                <ul>
                                    <li><input id="revise_limit_value" value=""><input id="revise_limit_value_unit" value=""></li>
                                    <li></li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                    <div style="width: 100px; height: 30px; margin-left: 48%; overflow: hidden">
                        <input type="button" readonly value="提交" id="submit" class="btn" style="25px;">
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

</body>
<script type="text/javascript" src="../../js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../../js/sweet-alert.min.js"></script>
<script type="text/javascript" src="../../js/logOut.js"></script>
<script type="text/javascript" src="../../js/jPages.js"></script>
<script type="text/javascript" src="../../js/utils.js"></script>
<script type="text/javascript" src="energy_consumption.js"></script>
<script src="../../js/account.js"></script>
</html>
