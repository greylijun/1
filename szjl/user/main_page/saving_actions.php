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
        .equip_query .div1 > ul{width: 390px;}
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
                <li><a href="rules.php">政策法规</a></li>
                <li class="on"><a href="saving_actions.php">节能措施</a></li>
            </ul>
        </div>
        <div class="exchange_div">
            <div id="mp_4">
                <div class="bar">
                    <p><a href="../main_page/inform.php"><img src="../../image/home.png"> </a><a href="../main_page/inform.php">首页</a><a>节能措施</a></p>
                </div>
                <div class="content">
                    <div class="equip_query">
                        <div class="div1">
                            <label>
                                节能措施一览表
                            </label>
                            <ul>
                                <li>
                                    <p>年度：</p>
                                    <select id="year_select">
                                        <option>全年度</option>
                                        <option>2015</option>
                                        <option>2016</option>
                                        <option>2017</option>
                                        <option>2018</option>
                                        <option>2019</option>
                                        <option>2020</option>
                                    </select>
                                </li>
                                <li>
                                    <p>完成状态：</p>
                                    <select id="state">
                                        <option>已完成</option>
                                        <option>未完成</option>
                                    </select>
                                </li>
                            </ul>
                            <input type="button" id="query_saving" value="查询" readonly="true" class="btn" style="float: none;margin-left: 48%;">
                            </div>
                        <div class="table">
                            <table>
                                <tr>
                                    <td>序号</td>
                                    <td>年份</td>
                                    <td>项目名称</td>
                                    <td>开始时间</td>
                                    <td>结束时间</td>
                                    <td>投资额（万元）</td>
                                    <td>节约金额（万元/年）</td>
                                    <td>节能量（tce/年）</td>
                                    <td>回收期（年）</td>
                                    <td>是否完成</td>
                                    <td>查看明细</td>
                                </tr>
                                <tbody id="saving_table"></tbody>
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
<script src="../../js/sweet-alert.min.js"></script>
<script src="saving_actions.js"></script>
<script src="../../js/account.js"></script>
<script src="../../js/logOut.js"></script>
</body>
</html>
