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
        .equip_query .div1 ul{ width: 975px;}
        .table tr td:first-child input{ width: 15px; margin: 5px; border: none;}
        .table tr td input{ height: 25px; border: 1px solid #ccc; width: 80px;background: #fff;}
        .table tr td:nth-child(9) input:first-child{ border: 1px solid #ccc; height: 25px; width: 80%; outline: none; background: #fff; margin: 2px auto;}
        .table tr td:nth-child(13) input:first-child{ border: 1px solid #ccc; height: 25px; width: 80%; outline: none; background: #fff; margin: 2px auto;}
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
                <li><a class="active" href="../../information_check/">信息审核</a></li>
                <li><a href="../../information_release/">信息发布</a></li>
                <li><a href="../../view_communication/">意见交流</a></li>
                <li><a href="../../data_revise/">数据修正</a></li>
                <li><a href="../../site_operation/">现场施工</a></li>
            </ul>
        </nav>
    </header>
    <main role="main">
        <div class="menu">
            <ul>
                <li><a href="../index.php">信息概括</a></li>
                <li class="on"><a href="../consumption_check/consumption_check.php">限额审核</a></li>
                <li><a href="../register_check/register_check.php">注册审核</a></li>
                <li><a href="../data_check/data_check.php">数据录入审核</a></li>
            </ul>
        </div>
        <div class="exchange_div">
            <div class="bar">
                <p><a href="../../information_check/"><img src="../../../image/home.png"> </a><a href="../../information_check/">信息审核</a><a>限额审核</a></p>
            </div>
            <div class="content">
                <div class="equip_query">
                    <div class="div1">
                        <label>
                            限额审核一览表
                        </label>
                        <ul>
                            <li>
                                <p>所在区域：</p>
                                <select id="area">
                                    <option value="全市">全市</option>
                                    <option value="姑苏区">姑苏区</option>
                                    <option value="园区">园区</option>
                                    <option value="高新区">高新区</option>
                                    <option value="吴中区">吴中区</option>
                                    <option value="相城区">相城区</option>
                                    <option value="吴江区">吴江区</option>
                                    <option value="昆山市">昆山市</option>
                                    <option value="常熟市">常熟市</option>
                                    <option value="张家港市">张家港市</option>
                                    <option value="太仓市">太仓市</option>
                                </select>
                            </li>
                            <li>
                                <p>行业类型：</p>
                                <select id="industry">
                                    <option>全行业</option>
                                    <option>医药</option>
                                    <option>建筑</option>
                                    <option>冶金</option>
                                    <option>机械</option>
                                    <option>电子</option>
                                    <option>信息</option>
                                    <option>交通</option>
                                    <option>其他</option>
                                </select>
                            </li>
                            <li>
                                <p>单位名称：</p>
                                <select id="name"></select>
                            </li>
                            <li>
                                <p>年份：</p>
                                <select id="year">
                                    <option>全部</option>
                                    <option>2015</option>
                                    <option>2016</option>
                                    <option>2017</option>
                                    <option>2018</option>
                                    <option>2019</option>
                                    <option>2020</option>
                                </select>
                            </li>
                            <li>
                                <p>审核状态：</p>
                                <select id="state">
                                    <option>全部</option>
                                    <option>未审核</option>
                                    <option>未通过审核</option>
                                    <option>通过审核</option>
                                </select>
                            </li>
                        </ul>
                        <div style=" float: left; width:90px; margin-left: 40%;">
                            <input class="btn" id="query" value="查询" readonly style=" width: 30px; margin: 0 10px;"/>
                        </div>
                        <div style=" float: left; width:110px;">
                            <input class="btn" id="pass" value="审核通过" readonly style=" width: 55px; margin: 0 10px;"/>
                        </div>
                        <div style=" float: left; width:90px;">
                            <input class="btn" id="nopass" value="审核不通过" readonly style=" width: 65px; margin: 0 10px;"/>
                        </div>
                    </div>
                    <br/>
                    <div class="table">
                        <table>
                            <tr>
                                <td>复选框</td>
                                <td>序号</td>
                                <td>单位名称</td>
                                <td>年份</td>
                                <td>水的单位<br>综合能耗</td>
                                <td>水的<br>定额值</td>
                                <td>水的<br>填报值</td>
                                <td>水的<br>修改值</td>
                                <td>能源的单位<br>综合能耗</td>
                                <td>能源的<br>定额值</td>
                                <td>能源的<br>填报值</td>
                                <td>能源的<br>修改值</td>
                                <td>限额选择</td>
                                <td>审核状态</td>
                                <td>详情</td>
                            </tr>
                            <tbody id="limit_table"></tbody>
                        </table>
                    </div>
                    <div class="page"></div>
                </div>
                <div id="HBox">
                    <form action="" method="post" onsubmit="return false;">
                        <div class="table">
                            <table>
                                <tr>
                                    <td>编号</td>
                                    <td>类别名称</td>
                                    <td>单位限额</td>
                                    <td>产量</td>
                                    <td>限额值</td>
                                </tr>
                                <tbody id="query_table"></tbody>
                            </table>
                        </div>
                        <div id="page" class="page"></div>
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
<script src="../../../js/jPages.js"></script>
<script src="../../../js/account.js"></script>
<script src="consumption_check.js"></script>
</body>
</html>
