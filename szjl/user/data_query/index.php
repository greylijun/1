<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>苏州市用能单位能源计量数据在线采集系统</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../style/user.css">
    <link rel="stylesheet" href="../../style/jquery.datetimepicker.css">
    <link rel="stylesheet" href="../../style/sweet-alert.css">
    <style>
        .menu ul li{ width: 50%;}
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
                <li><a class="active" href="../data_query/">数据查询</a></li>
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
                <li class="on"><a href="index.php">历史数据</a></li>
                <li><a href="data_analysis.php">数据分析</a></li>
            </ul>
        </div>
        <div class="exchange_div">
            <div id="dq_1">
                <div class="bar">
                    <p><a href="../main_page/inform.php"><img src="../../image/home.png"> </a><a href="../data_query/">数据查询</a><a>历史数据</a></p>
                    <ul id="change_value">
                        <li value="daily_indiff_value" id="equivalent_value"><a>等价值</a></li>
                        <li class="on" value="daily_equival_value" id="weight_value"><a>当量值</a></li>
                    </ul>
                </div>
                <div class="content">
                    <div class="dq_div1">
                        <div class="menu_bar">
                            <ul id="report">
                                <li><a class="on" id="year">年报表</a></li>
                                <li><a id="season">季报表</a></li>
                                <li><a id="month">月报表</a></li>
                                <li><a id="week">周报表</a></li>
                                <li><a id="day">日报表</a></li>
                                <li><a id="hour">时报表</a></li>
                            </ul>
                        </div>
                        <ul class="data_query_ul1">
                            <!--<li>
                                <input type="radio" value="resource" name="type" checked="checked" >资源
                                <input type="radio" value="industry" name="type" >行业
                                <input type="radio" value="region" name="type" >地区
                            </li>-->
                        </ul>
                        <ul class="data_query_ul2">
                            <li class="year_report">
                                <label>年度：</label>
                                <input id="QueryYear">
                            </li>
                            <li class="season_report_s">
                                <label>季度：</label>
                                <input id="QuerySeasonStart">
                            </li>
                            <li class="season_report_e">
                                <label>至</label>
                                <input id="QuerySeasonEnd">
                            </li>
                            <li class="month_report_s">
                                <label>月：</label>
                                <input id="QueryMonthStart">
                            </li>
                            <li class="month_report_e">
                                <label>至</label>
                                <input id="QueryMonthEnd">
                            </li>
                            <li class="week_report_s">
                                <label>周：</label>
                                <input id="QueryWeekStart">
                            </li>
                            <li class="week_report_e">
                                <label>至</label>
                                <input id="QueryWeekEnd">
                            </li>
                            <li class="day_report_s">
                                <label>日：</label>
                                <input id="QueryDayStart" class="laydate-icon" onclick="laydate()" id="day_time_start">
                            </li>
                            <li class="day_report_e">
                                <label>至</label>
                                <input id="QueryDayEnd" class="laydate-icon" onclick="laydate()" id="day_time_end">
                            </li>
                            <li class="hour_report">
                                <label>时：</label>
                                <input id="QueryHourStart">
                            </li>
                            <li class="hour_report">
                                <label>至</label>
                                <input id="QueryHourEnd">
                            </li>
                            <input id="button" class="btn" value="查询" readonly="true">
                        </ul>
                    </div>
                    <div class="dq_div2">
                        <div class="menu_bar"><img src="../../image/dq_2.png">资源消耗图</div>
						<div id="ResourceConsumptionColumn" style="width: 100%;height: 170px;"></div>
                    </div>
                    <div class="dq_div4">
                        <div class="menu_bar"><img src="../../image/dq_4.png">资源消耗饼状图</div>
                        <div id="ResourceConsumptionPie" style="width: 100%; height: 450px;"></div>
                    </div>
                    <div class="dq_div3">
                        <div class="menu_bar"><img src="../../image/dq_3.png">资源消耗表
                            <ul class="right">
                                <li><a id="export_report">导出报表</a> </li>
                                <li><a id="online_print">在线打印</a></li>
                            </ul>
                        </div>
                        <table id="SourceTable">
                            <!--<tr>
                                <td>资源类型</td>
                                <td>用能量/吨标煤</td>
                                <td>限额/吨标煤</td>
                                <td>占消耗总量百分比</td>
                            </tr>
                            <tr>
                                <td>水</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <td>电</td>
                                <td>5000</td>
                                <td rowspan="6">1000</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <td>煤</td>
                                <td>1000</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <td>油</td>
                                <td>1000</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <td>蒸汽</td>
                                <td>1000</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <td>天然气</td>
                                <td>1000</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <td>冷量</td>
                                <td>1000</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <td>能源总量</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>10%</td>
                            </tr>
                            <tr>
                                <td>资源总量</td>
                                <td>1000</td>
                                <td>1000</td>
                                <td>10%</td>
                            </tr>-->
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
<script src="../../js/jquery.datetimepicker.js"></script>
<script src="data_query.js"></script>
<script src="../../js/account.js"></script>
<script src="../../js/laydate/laydate.js"></script>
<script>
    $('#QueryHourStart').datetimepicker();
    $('#QueryHourEnd').datetimepicker();
</script>
</body>
</html>
