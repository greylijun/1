<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>苏州市用能单位能源计量数据在线采集系统</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../style/admin.css">
    <link rel="stylesheet" href="../../style/sweet-alert.css">
    <style>
        .menu ul li{ width: 100%;}
        .menu ul li.on a::after{margin-left: -60px;}
        .table tr td:last-child{ width: 100px;}
        .table tr td:last-child div{ display: block; height: 30px; width: 100%;overflow: hidden; text-align: center;}
        .table tr{height: 35px;}
        .table tr td:last-child div input{ width:30px; height: 20px; font-size: 14px; margin-left: 18px;}
        .equip_query .div1 ul{ width: 740px;}
        .equip_query .div1>ul>li:first-child{width: 350px;}
        .equip_query .div1 ul.ul1{ width: 1000px;}
        .equip_query .div1 ul.ul1 li{width: 33.3333%;}
        .table table tr:nth-child(2n+1) input{ background: #15497e;}
        .table table tr td input{ width:30px; margin-left:20px;;}
    </style>
</head>
<?php
session_start();
if(!isset($_SESSION['admin_tsn'])){
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
                    <span>管理员</span>
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
                <li><a href="../information_check/">信息审核</a></li>
                <li><a href="../information_release/">信息发布</a></li>
                <li><a href="../view_communication/">意见交流</a></li>
                <li><a href="../data_revise/">数据修正</a></li>
                <li><a class="active" href="../site_operation/">现场施工</a></li>
            </ul>
        </nav>
    </header>
    <main role="main">
        <div class="menu">
            <ul>
                <li class="on"><a href="index.php">通讯设备维护</a></li>
            </ul>
        </div>
        <div class="exchange_div">
            <div class="bar">
                <p><a href="../information_check/index.php"><img src="../../image/home.png"> </a><a href="index.php">现场施工</a><a>通讯设备维护</a></p>
            </div>
            <div class="content">
                <div class="equip_query">
                    <div class="div1">
                        <label>
                            能源计量通讯模块一览表
                        </label>
                        <ul>
                            <li>
                                <p>单位名称：</p>
                                <input type="text" id="unit" onblur="hide();" onFocus="checkUnitValue();"onKeyUp="checkUnitValue();">
                                <ul id="unit_possible"></ul>
                            </li>
                            <li>
                                <p>能源类型：</p>
                                <select id="energy_type">
                                    <option>全部</option>
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
                                <p>模块编号：</p>
                                <input id="model_number">
                            </li>
                        </ul>
                        <div style="width: 100px; height: 30px; margin-left: 48%; overflow: hidden; float: left;">
                            <input id="query" class="btn" value="查询" readonly style=" width: 25px;"/>
                        </div>
                    </div>
                    <div class="table" style="height:220px; border-bottom: 2px solid #eae0d0;">
                        <table>
                            <tr>
                                <td>序号</td>
                                <td>单位名称</td>
                                <td>管理编号</td>
                                <td>上一级管理编号</td>
                                <td>分级分项</td>
                                <td>资源类型</td>
                                <td>具体资源类型</td>
                                <td>当量系数</td>
                                <td>等价系数</td>
                                <td>器具名称</td>
                                <td>型号</td>
                                <td>操作</td>
                            </tr>
                            <tbody id="site_query"></tbody>
                        </table>
                        <div class="page" id="page"></div>
                    </div>
                    <div class="div1" style="height: 200px; padding: 0">
                        <label>
                            <input value="增加新设备" readonly="true">
                        </label>
                        <ul class="ul1">
                            <li>
                                <p>单位名称：</p>
                                <input type="text" id="InsertUnitName" onblur="hideul();" onFocus="checkTextValue();"onKeyUp="checkTextValue();" name="equipment">
                                <ul id="possible"></ul>
                            </li>
                            <li>
                                <p>管理编号：</p>
                                <input id="InsertModuleId" name="equipment">
                            </li>
                            <li>
                                <p>上一级管理编号：</p>
                                <input id="InsertUpperLevelModuleId" name="equipment">
                            </li>

                        </ul>
                        <ul class="ul1">
                            <li>
                                <p>分级分项：</p>
                                <select id="InsertMeterLevel">
                                    <option value="1">一级</option>
                                    <option value="2">二级</option>
                                    <option value="3">三级</option>
                                </select>
                            </li>
                            <li>
                                <p>资源类型：</p>
                                <select id="InsertResourceType" onchange="QuerySpecificResourceType()">
                                    <option value="水">水</option>
                                    <option value="电">电</option>
                                    <option value="煤">煤</option>
                                    <option value="油">油</option>
                                    <option value="蒸汽">蒸汽</option>
                                    <option value="天然气">天然气</option>
                                    <option value="冷量">冷量</option>
                                </select>
                            </li>
                            <li>
                                <p>具体资源类型：</p>
                                <select id="InsertSpecificResourceType" onchange="ChangeFactor()">
                                </select>
                            </li>
                        </ul>
                        <ul class="ul1">

                            <li>
                                <p>当量系数：</p>
                                <input id="InsertEquivalentCoefficient">
                            </li>
                            <li>
                                <p>等价系数：</p>
                                <input id="InsertEquivalentFactor">
                            </li>
                            <li>
                                <p>器具名称：</p>
                                <input id="EquipmentName" name="equipment">
                            </li>
                        </ul>
                        <ul class="ul1">
                            <li>
                                <p>型号：</p>
                                <input id="Model" name="equipment">
                            </li>
                            <div style="float: left; height: 40px; margin-left: 200px;">
                                <input id="add" class="btn" value="增加" readonly style=" width: 25px;"/>
                            </div>
                        </ul>

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
<script src="../../js/jPages.js"></script>
<script src="../../js/sweet-alert.min.js"></script>
<script src="../../js/logOut.js"></script>
<script src="../../js/account.js"></script>
<script src="site_operation.js"></script>
</body>
</html>
