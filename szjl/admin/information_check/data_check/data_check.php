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
        .menu ul li.on a::after{margin-left: -58px;}
        .table tr td:first-child input{ width: 15px; margin: 5px; border: none;}
        .table tr td input{ height: 25px; border: 1px solid #ccc; width: 80px;background: #fff;}
        .table table tbody:first-child tr:nth-child(2){ background: #999;}
        .table table tr:nth-child(2n+1) input{background: #fff;}
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
                <li><a href="../consumption_check/consumption_check.php">限额审核</a></li>
                <li><a href="../register_check/register_check.php">注册审核</a></li>
                <li class="on"><a href="../data_check/data_check.php">数据录入审核</a></li>
            </ul>
        </div>
        <div class="exchange_div">
            <div class="bar">
                <p><a href="../../information_check/"><img src="../../../image/home.png"> </a><a href="../../information_check/">信息审核</a><a>数据录入审核</a></p>
            </div>
            <div class="content">
                <div class="equip_query">
                    <div class="div1">
                        <label>
                            录入数据审核一览表
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
                                <select id="name">
                                </select>
                            </li>
                            <li>
                                <p>填报日期：</p>
                                <input id="date" class="laydate-icon" onclick="laydate()">
                            </li>
                            <li>
                                <p>审核状态：</p>
                                <select id="state">
                                    <option>未审核</option>
                                    <option>未通过审核</option>
                                    <option>通过审核</option>
                                </select>
                            </li>
                        </ul>
                        <div style=" float: left; width:90px; margin-left: 40%;">
                            <input class="btn" id="query" value="查询" readonly="true" style=" width: 30px; margin: 0 10px;"/>
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
                                <td rowspan="2">复选框</td>
                                <td rowspan="2">序号</td>
                                <td rowspan="2">单位名称</td>
                                <td rowspan="2">填报日期</td>
                                <td rowspan="2">修改月份</td>
                                <td colspan="7">等价原始数据/tce</td>
                                <td colspan="7">等价修改数据/tce</td>
                                <td rowspan="2">审核状态</td>
                                <td rowspan="2" style="width: 60px;">详情</td>
                                <td rowspan="2">查看凭证</td>
                            </tr>
                            <tr>
                                <td>（水</td>
                                <td>电</td>
                                <td>煤</td>
                                <td>油</td>
                                <td>天然气</td>
                                <td>蒸汽</td>
                                <td>冷量）</td>
                                <td>（水</td>
                                <td>电</td>
                                <td>煤</td>
                                <td>油</td>
                                <td>天然气</td>
                                <td>蒸汽</td>
                                <td>冷量）</td>
                            </tr>
                            <tbody id="data_table"></tbody>
                        </table>
                    </div>
                    <div class="page"></div>
                </div>
                <div id="HBox" style=" overflow: auto;">
                    <form action="" method="post" onsubmit="return false;">
                        <div class="de1 table" style="border: 0;">
                            <table>
                                <tr>
                                    <td>能源大类名称</td>
                                    <td colspan="2">能源小类名称</td>
                                    <td>消耗值</td>
                                    <td>折标系数</td>
                                </tr>
                                <tr>
                                    <td rowspan="5">煤</td>
                                    <td colspan="2" >原煤</td>
                                    <td><input id="coal1" name='data'>kg</td>
                                    <td>0.7143kgce/kg</td>
                                </tr>
                                <tr>
                                    <td colspan="2">洗精煤</td>
                                    <td><input id="coal2" name='data'>kg</td>
                                    <td>0.9000kgce/kg</td>
                                </tr>
                                <tr>
                                    <td rowspan="2">其他洗煤</td>
                                    <td>洗中煤</td>
                                    <td><input id="coal3" name='data'>kg</td>
                                    <td>0.2857kgce/kg</td>
                                </tr>
                                <tr>
                                    <td>煤泥</td>
                                    <td><input id="coal4" name='data'>kg</td>
                                    <td>0.2857kgce/kg~0.4286kgce/kg</td>
                                </tr>
                                <tr>
                                    <td colspan="2">焦炭</td>
                                    <td><input id="coal5" name='data'>kg</td>
                                    <td>0.9714kgce/kg</td>
                                </tr>
                                <tr>
                                    <td rowspan="7">油</td>
                                    <td colspan="2">原油</td>
                                    <td><input id="oil1" name='data'>kg</td>
                                    <td>1.4286kgce/kg</td>
                                </tr>
                                <tr>
                                    <td colspan="2">燃料油</td>
                                    <td><input id="oil2" name='data'>kg</td>
                                    <td>1.4286kgce/kg</td>
                                </tr>
                                <tr>
                                    <td colspan="2">汽油</td>
                                    <td><input id="oil3" name='data'>kg</td>
                                    <td>1.4714kgce/kg</td>
                                </tr>
                                <tr>
                                    <td colspan="2">煤油</td>
                                    <td><input id="oil4" name='data'>kg</td>
                                    <td>1.4286kgce/kg</td>
                                </tr>
                                <tr>
                                    <td colspan="2">柴油</td>
                                    <td><input id="oil5" name='data'>kg</td>
                                    <td>1.4571kgce/kg</td>
                                </tr>
                                <tr>
                                    <td colspan="2">煤焦油</td>
                                    <td><input id="oil6" name='data'>kg</td>
                                    <td>1.1429kgce/kg</td>
                                </tr>
                                <tr>
                                    <td colspan="2">渣油</td>
                                    <td><input id="oil7" name='data'>kg</td>
                                    <td>1.4286kgce/kg</td>
                                </tr>
                                <tr>
                                    <td>冷量</td>
                                    <td colspan="2">冷量</td>
                                    <td><input id="cold_quantity" name='data'>MJ</td>
                                    <td>0.03412kgce/MJ</td>
                                </tr>
                                <tr>
                                    <td>蒸汽</td>
                                    <td colspan="2">蒸汽（低压）</td>
                                    <td><input id="steam" name='data'>kg</td>
                                    <td>0.1286kgce/kg</td>
                                </tr>
                                <tr>
                                    <td rowspan="3">水</td>
                                    <td colspan="2">新水</td>
                                    <td><input id="water1" name='data'>t</td>
                                    <td>0.0857kgce/t</td>
                                </tr>
                                <tr>
                                    <td colspan="2">软水</td>
                                    <td><input id="water2" name='data'>t</td>
                                    <td>0.4857kgce/t</td>
                                </tr>
                                <tr>
                                    <td colspan="2">除氧水</td>
                                    <td><input id="water3" name='data'>t</td>
                                    <td>0.9714kgce/t</td>
                                </tr>
                            </table>
                            <table style="margin-left: 1%;">
                                <tr>
                                    <td>能源大类名称</td>
                                    <td colspan="2">能源小类名称</td>
                                    <td>消耗值</td>
                                    <td>折标系数</td>
                                </tr>
                                <tr>
                                    <td rowspan="13">天然气</td>
                                    <td colspan="2">液化石油气</td>
                                    <td><input id="gas1" name='data'>kg</td>
                                    <td>0.7143kgce/kg</td>
                                </tr>
                                <tr>
                                    <td colspan="2">炼厂干气</td>
                                    <td><input id="gas2" name='data'>kg</td>
                                    <td>0.5714kgce/kg</td>
                                </tr>
                                <tr>
                                    <td colspan="2">油田天然气</td>
                                    <td><input id="gas3" name='data'>m<sup>3</sup></td>
                                    <td>0.3300kgce/m<sup>3</sup></td>
                                </tr>
                                <tr>
                                    <td colspan="2">气田天然气</td>
                                    <td><input id="gas4" name='data'>m<sup>3</sup></td>
                                    <td>0.2143kgce/m<sup>3</sup></td>
                                </tr>
                                <tr>
                                    <td colspan="2">煤矿瓦斯气</td>
                                    <td><input id="gas5" name='data'>m<sup>3</sup></td>
                                    <td>0.5000kgce/m<sup>3</sup>~0.5714kgce/m<sup>3</sup></td>
                                </tr>
                                <tr>
                                    <td colspan="2">焦炉煤气</td>
                                    <td><input id="gas6" name='data'>m<sup>3</sup></td>
                                    <td>0.5714kgce/m<sup>3</sup>~0.6143kgce/m<sup>3</sup></td>
                                </tr>
                                <tr>
                                    <td colspan="2">高炉煤气</td>
                                    <td><input id="gas7" name='data'>m<sup>3</sup></td>
                                    <td>0.1286kgce/m<sup>3</sup></td>
                                </tr>
                                <tr>
                                    <td rowspan="6">其他煤气</td>
                                    <td >发生炉煤气</td>
                                    <td><input id="gas8" name='data'>m<sup>3</sup></td>
                                    <td>0.1786kgce/m<sup>3</sup></td>
                                </tr>
                                <tr>
                                    <td>重油催化裂解煤气</td>
                                    <td><input id="gas9" name='data'>m<sup>3</sup></td>
                                    <td>0.6571kgce/m<sup>3</sup></td>
                                </tr>
                                <tr>
                                    <td>重油热裂解煤气</td>
                                    <td><input id="gas10" name='data'>m<sup>3</sup></td>
                                    <td>1.2143kgce/m<sup>3</sup></td>
                                </tr>
                                <tr>
                                    <td>焦炭制气</td>
                                    <td><input id="gas11" name='data'>m<sup>3</sup></td>
                                    <td>0.5571kgce/m<sup>3</sup></td>
                                </tr>
                                <tr>
                                    <td>压力气化煤气</td>
                                    <td><input id="gas12" name='data'>m<sup>3</sup></td>
                                    <td>0.5143kgce/m<sup>3</sup></td>
                                </tr>
                                <tr>
                                    <td>水煤气</td>
                                    <td><input id="gas13" name='data'>m<sup>3</sup></td>
                                    <td>0.3571kgce/m<sup>3</sup></td>
                                </tr>

                                <tr>
                                    <td>电</td>
                                    <td colspan="2">电</td>
                                    <td><input id="electricity" name='data'>kW·h</td>
                                    <td>
                                        当量值：0.1229kgce/（kW·h）<br>等价值：4.0400kgce/（kW·h）</td>
                                </tr>
                            </table>
                        </div>
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
            <p>联系电话：0512-67299923</p>
        </div>
    </footer>
</div>
<script src="../../../js/jquery-1.11.1.min.js"></script>
<script src="../../../js/sweet-alert.min.js"></script>
<script src="../../../js/logOut.js"></script>
<script src="../../../js/laydate/laydate.js"></script>
<script src="../../../js/jquery.hDialog.js"></script>
<script src="../../../js/jPages.js"></script>
<script src="../../../js/account.js"></script>
<script src="data_check.js"></script>
</body>
</html>
