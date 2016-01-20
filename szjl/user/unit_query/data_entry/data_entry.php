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
        .area li{ width: 15%;}
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
    <main role="main" style="height: 750px;">
        <div class="menu">
            <ul>
                <li><a href="../unit_intro/unit_intro.php">单位简介</a></li>
                <li><a href="../real_data/real_data.php">实时数据</a></li>
                <li><a href="../current_collect/current_collect.php">实时采集</a> </li>
                <li class="on"><a href="../data_entry/data_entry.php">数据录入</a> </li>
            </ul>
        </div>
        <div class="exchange_div" style="height: 700px;">
            <div id="sz_query">
                <div class="bar">
                    <p><a href="../../main_page/inform.php"><img src="../../../image/home.png"> </a><a href="../../unit_query/unit_intro/unit_intro.php">单位查询</a><a>数据录入</a></p>
                </div>
            </div>
            <div class="content" style="height: 650px;">
                <div class="data_entry">
                    <div class="area">
                        <ul>
                            <li class="active" id="consumption_entry"><a>月能耗数据录入</a></li>
                            <li id="energy_saving_entry"><a>节能措施录入</a></li>
                            <li>&nbsp       </li>
                        </ul>
                    </div>
                    <div id="de1">
                        <div class="select">
                            <span>
                            <p>年：</p>
                            <div style="width: 80px; float: left; height: 30px; display: block; overflow: hidden; margin-right: 20px; overflow: hidden;">
                                <select id="data_year">
                                    <option>2015</option>
                                    <option>2016</option>
                                    <option>2017</option>
                                    <option>2018</option>
                                    <option>2019</option>
                                    <option>2020</option>
                                </select>
                            </div>
                            <p>月：</p>
                            <div style="width: 80px; float: left; height: 30px; display: block; overflow: hidden; margin-right: 20px; overflow: hidden;">
                                <select id="data_month">
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
                            </div>
                            <p>上传数据凭证：</p>
                            <div style="width: 200px; float: left; height: 30px; display: block; overflow: hidden; margin-right: 20px; overflow: hidden;">
                                <form id="submit0" action="upload_data.php?file0=file0" method="post" enctype="multipart/form-data">
                                <input type="file" name="file0" id="file0" style="width: 200px; outline: none;">
                                    </form>
                            </div>
                        </span>
                        </div>
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
                        <input class="btn" value="提交" id="submit" readonly type="button" style="margin: 10px 48%;">
                    </div>
                    <div id="de2">
                        <div class="de_div">
                            <div class="bgc">
                                <h1>今年节能措施计划表</h1>
                                <table>
                                    <tr>
                                        <td>
                                            <p>项目名称：</p>
                                            <input id="project_name" name='this_year' onblur="query_name()">
                                        </td>
                                        <td>
                                            <p>投资额：</p>
                                            <input id="investment" name='this_year'>万元
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <p>开始时间：</p>
                                            <input id="start_time" name='this_year' class="laydate-icon" onclick="laydate()" style="padding: 0">
                                        </td>
                                        <td>
                                            <p>结束时间：</p>
                                            <input id="end_time" name='this_year' class="laydate-icon" onclick="laydate()" style="padding: 0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>回收期：</p>
                                            <input id="payback" name='this_year'>年
                                        </td>
                                        <td>
                                            <p>技改方案内容：</p>
                                            <form id="submit2" action="upload.php?file=file" method="post" enctype="multipart/form-data">
                                                <input type="file" name="file" id="file"  style="border:none;outline: none; font-size: 14px;">
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>节约量金额：</p>
                                            <input id="saving_money" name='this_year'>万元/年
                                        </td>
                                        <td>
                                            <p>节能量：</p>
                                            <input id="material_volume" name='this_year'>tce/年
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <input id="method_submit" class="btn" type="button" value="提交" readonly="true">
                        </div>
                        <div class="de_div">
                            <div class="bgc">
                                <h1>历年节能措施完成表</h1>
                                <table>
                                    <tr>
                                        <td>
                                            <p>项目名称：</p>
                                            <select id="pro_name" name="finish_year"></select>
                                        </td>
                                        <td>
                                            <p>投资额：</p>
                                            <input id="finish_investment" name="finish_year" value="">万元
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <p>开始时间：</p>
                                            <input id="start_time_finish" name='finish_year' class="laydate-icon" onclick="laydate()" style="padding: 0">
                                        </td>
                                        <td>
                                            <p>结束时间：</p>
                                            <input id="end_time_finish" name='finish_year' class="laydate-icon" onclick="laydate()" style="padding: 0">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <p>回收期：</p>
                                            <input id="finish_payback" name="finish_year" value="">年
                                        </td>
                                        <td>
                                            <p>技改方案内容：</p>
                                            <form id="submit3" action="upload_finish.php?file2=file2" method="post" enctype="multipart/form-data">
                                                <input type="file" name="file2" id="file2" style="border:none;outline: none; font-size: 14px;">
                                            </form>
                                            <br/>
                                            <input id="download" type="button" value="计划的技改方案内容下载
" readonly="true" style=" width: 200px; margin:0 0 0 180px; border: none;" class="btn"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>节约量金额：</p>
                                            <input id="finish_saving_money" name="finish_year" value="">万元/年
                                        </td>
                                        <td>
                                            <p>节能量：</p>
                                            <input id="finish_material_volume" name="finish_year" value="">tce/年
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <input class="btn" type="button" value="提交" readonly="true" id="finish_submit">
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
<script src="../../../js/laydate/laydate.js"></script>
<script src="../../../js/jquery-1.11.1.min.js"></script>
<script src="../../../js/jquery.form.js"></script>
<script src="../../../js/sweet-alert.min.js"></script>
<script src="../../../js/logOut.js"></script>
<script src="../../../js/account.js"></script>
<script src="data_entry.js"></script>
</body>
</html>
