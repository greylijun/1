<!doctype html>
<html class="no-js" lang="" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>苏州市用能单位能源计量数据在线采集系统</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../style/admin.css">
    <link rel="stylesheet" href="../../../style/sweet-alert.css">
    <style>
        .table tr td:first-child input{ width: 15px; margin: 5px; border: none;}
        .equip_query .div1 ul{ width: 780px;}
        .table table tr td input{outline: none; width: 150px; border: 1px solid #ccc; height: 25px; background: #fff;}
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
                <li class="on"><a href="../register_check/register_check.php">注册审核</a></li>
                <li><a href="../data_check/data_check.php">数据录入审核</a></li>
            </ul>
        </div>
        <div class="exchange_div">
            <div class="bar">
                <p><a href="../../information_check/"><img src="../../../image/home.png"> </a><a href="../../information_check/">信息审核</a><a>注册审核</a></p>
            </div>
            <div class="content">
                <div class="equip_query">
                    <div class="div1">
                        <label>
                            注册审核一览表
                        </label>
                        <ul style="width:1000px;">
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
                                <p>一级行业：</p>
                                <select id="industry">
                                    <option>全行业</option>
                                    <option>制造业</option>
                                    <option>建筑业</option>
                                    <option>金融业</option>
                                    <option>教育</option>
                                    <option>批发和零售业</option>
                                    <option>交通运输、仓储和邮政业</option>
                                    <option>住宿和餐饮业</option>
                                    <option>信息传输、软件和信息技术服务业</option>
                                    <option>房地产业</option>
                                    <option>租赁和商务服务业</option>
                                    <option>科学研究和技术服务业</option>
                                    <option>水利、环境和公共设施管理业</option>
                                    <option>居民服务、修理和其他服务业</option>
                                    <option>卫生和社会工作</option>
                                    <option>文化、体育和娱乐业</option>
                                    <option>公共管理、社会保障和社会组织</option>
                                    <option>采矿业</option>
                                    <option>农、林、牧、渔业</option>
                                    <option>国际组织</option>
                                </select>
                            </li>
                            <li>
                                <p>二级行业：</p>
                                <select id="second_industry_type">
                                </select>
                            </li>
                            <li>
                                <p>单位名称：</p>
                                <select id="name">
                                </select>
                            </li>
                            <li>
                                <p>审核状态：</p>
                                <select id="state">
                                    <option>未审核</option>
                                    <option>通过审核</option>
                                    <option>未通过审核</option>
                                </select>
                            </li>
                        </ul>
                        <div style=" float: left; width:90px; margin-left: 32%">
                            <input class="btn" id="query" value="查询" readonly style=" width: 30px; margin: 0 10px;"/>
                        </div>
                        <div style=" float: left; width:110px;">
                            <input class="btn" id="pass" value="审核通过" readonly style=" width: 55px; margin: 0 10px;"/>
                        </div>
                        <div style=" float: left; width:130px;">
                            <input class="btn" id="nopass" value="审核不通过" readonly style=" width: 70px; margin: 0 10px;"/>
                        </div>
                        <div style=" float: left; width:110px;">
                            <a href="http://api.map.baidu.com/lbsapi/getpoint/index.html" target="_blank" class="btn" style=" width: 70px; height: 20px; line-height: 20px; margin: 0 10px;">经纬度查询</a>
                        </div>
                        <div style=" float: left; width:130px;">
                            <input class="btn" onclick="delete1()" value="删除未通过审核企业" readonly class="btn" style=" width: 120px; height: 20px; line-height: 20px; margin: 0 10px;"/>
                        </div>
                    </div>
                    <br/>
                    <div class="table">
                        <table>
                            <tr>
                                <td>复选框</td>
                                <td>序号</td>
                                <td>所在区域</td>
                                <td>行业类型</td>
                                <td>单位名称</td>
                                <td>企业联系人</td>
                                <td>联系人号码</td>
                                <td>单位电话</td>
                                <td>经度</td>
                                <td>纬度</td>
                                <td>营业执照图片</td>
                                <td>审核状态</td>
                                <td>详情</td>
                            </tr>
                            <tbody id="register_table"></tbody>
                        </table>
                    </div>
                    <div class="page"></div>
                </div>
                <div id="HBox">
                    <form action="" method="post" onsubmit="return false;">
                        <div class="ui_div3">
                            <table>
                                <tr>
                                    <td><p>企业名称：</p><input id="unit_name" value="" readonly="true"/></td>
                                    <td><p>营业执照注册号：</p><input id="lic_number" value="" readonly="true"/></td>
                                    <td><p>组织机构代码：</p><input id="org_code" value="" readonly="true"/></td>
                                </tr>
                                <tr>
                                    <td><p>企业法人：</p><input id="legal_person" value="" readonly="true"/></td>
                                    <td><p>企业联系人：</p><input id="business_contact" value="" readonly="true"/></td>
                                    <td><p>联系人号码：</p><input id="contact_num" value="" readonly="true"/></td>
                                </tr>
                                <tr>
                                    <td><p>所在区域：</p><input id="region" value="" readonly="true"/></td>
                                    <td><p>一级行业：</p><input id="industry_type" value="" readonly="true"/></td>
                                    <td><p>二级行业：</p><input id="second_industry_type_detail" value="" readonly="true"/></td>
                                </tr>
                                <tr>
                                    <td><p>用能单位类型：</p><input id="unit_industry_type" value="" readonly="true"></td>
                                    <td><p>企业电话：</p><input id="business_phone" value="" readonly="true"/></td>
                                    <td><p>邮政编码：</p><input id="zip_code" value="" readonly="true"/></td>
                                </tr>
                                <tr>
                                    <td><p>E-mail：</p><input id="E-mail" value="" readonly="true"/></td>
                                    <td><p>企业传真：</p><input id="fax" value="" readonly="true"/></td>
                                    <td><p>企业注册地址：</p><input id="reg" value="" readonly="true"/></td>
                                </tr>
                                <tr>
                                    <td><p>企业生产地址：</p><input id="pro" value="" readonly="true"/></td>
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
<script src="../../../js/jquery.hDialog.js"></script>
<script src="../../../js/sweet-alert.min.js"></script>
<script src="../../../js/logOut.js"></script>
<script src="../../../js/jPages.js"></script>
<script src="../../../js/account.js"></script>
<script src="register_check.js"></script>
</body>
</html>
