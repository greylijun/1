<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>苏州市用能单位能源计量数据在线采集系统</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../style/admin.css">
    <link rel="stylesheet" href="../../../style/sweet-alert.css">
    <style>
        .menu ul li{ width: 50%;}
        .equip_query .div1 ul{ width: 1170px;}
    </style>
</head>
<?php
session_start();
if(!isset($_SESSION['admin_tsn'])){
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
                <li><a href="../../information_check/">信息审核</a></li>
                <li><a href="../../information_release/">信息发布</a></li>
                <li><a href="../../view_communication/">意见交流</a></li>
                <li><a class="active" href="../../data_revise/">数据修正</a></li>
                <li><a href="../../site_operation/">现场施工</a></li>
            </ul>
        </nav>
    </header>
    <main role="main">
        <div class="menu">
            <ul>
                <li><a href="../index.php">修正数据</a></li>
                <li class="on"><a href="index.php">修正记录</a></li>
            </ul>
        </div>
        <div class="exchange_div">
            <div class="bar">
                <p><a href="../../information_check/index.php"><img src="../../../image/home.png"> </a><a href="../index.php">数据修正</a><a>修正记录</a></p>
            </div>
            <div class="content">
                <div class="equip_query">
                    <div class="div1">
                        <label>
                            修正记录一览表
                        </label>
                        <ul>
                            <li>
                                <p>所在区域：</p>
                                <select id="area">
                                    <option>全市</option>
                                    <option>姑苏区</option>
                                    <option>园区</option>
                                    <option>高新区</option>
                                    <option>吴中区</option>
                                    <option>吴江区</option>
                                    <option>相城区</option>
                                    <option>昆山市</option>
                                    <option>常熟市</option>
                                    <option>张家港市</option>
                                    <option>太仓市</option>
                                </select>
                            </li>
                            <li>
                                <p>单位名称：</p>
                                <select id="unit_name">
                                </select>
                            </li>
                            <li>
                                <p>资源类型：</p>
                                <select id="energy_type">
                                    <option>水</option>
                                    <option>电</option>
                                    <option>煤</option>
                                    <option>油</option>
                                    <option>蒸汽</option>
                                    <option>天然气</option>
                                    <option>冷量</option>
                                </select>
                            </li>
                            <li>
                                <p>修改类型：</p>
                                <select id="revise_type">
                                    <option>日数据修正</option>
                                    <option>月数据修正</option>
                                </select>
                            </li>
                            <li id="day">
                                <p>日期选择：</p>
                                <input class="laydate-icon" id="day_select"  onclick="laydate()">

                            </li>
                            <li id="month" style="display: none">
                                <p>年份选择：</p>
                                <select id="year_select">
                                    <option>2015</option>
                                    <option>2016</option>
                                    <option>2017</option>
                                    <option>2018</option>
                                    <option>2019</option>
                                    <option>2020</option>
                                    <option>2021</option>
                                </select>
                            </li>
                            <li id="month2" style="display: none">
                                <p>月份选择：</p>
                                <select id="month_select">
                                    <option>01</option>
                                    <option>02</option>
                                    <option>03</option>
                                    <option>04</option>
                                    <option>05</option>
                                    <option>06</option>
                                    <option>07</option>
                                    <option>08</option>
                                    <option>09</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                </select>
                            </li>
                        </ul>
                        <div style="width: 100px; height: 30px; margin-left: 48%; overflow: hidden">
                            <input id="query" class="btn" value="查询" readonly style=" width: 25px;"/>
                        </div>

                    </div>
                    <div class="table">
                        <table>
                            <tr>
                                <td>序号</td>
                                <td>单位名称</td>
                                <td>资源类型</td>
                                <td>修改时间</td>
                                <td>填报时间</td>
                                <td>原数据当量值</td>
                                <td>修正数据当量值</td>
                                <td>原数据等价值</td>
                                <td>修正数据等价值</td>
                            </tr>
                            <tbody id="query_table">
                            </tbody>
                        </table>
                    </div>
                    <div class="page"></div>
                </div>
                <div id="HBox">
                    <form action="" method="post" onsubmit="return false;">
                        <table class="table">
                            <tr>
                                <td>日期</td>
                                <td>原数据（tce）当量值</td>
                                <td>修正数据（tce）当量值</td>
                                <td>原数据（tce）等价值</td>
                                <td>修正数据（tce）等价值值</td>
                            </tr>
                            <tbody id="query_table"></tbody>
                        </table>
                    </form>
                </div><!-- HBox end -->
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
<script src="../../../js/sweet-alert.min.js"></script>
<script src="../../../js/logOut.js"></script>
<script src="../../../js/jquery.hDialog.js"></script>
<script src="../../../js/laydate/laydate.js"></script>
<script src="revise_record.js"></script>
<script src="../../../js/account.js"></script>
</body>
</html>
