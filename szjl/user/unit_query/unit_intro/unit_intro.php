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
    <main role="main">
        <div class="menu">
            <ul>
                <li class="on"><a href="../unit_intro/unit_intro.php">单位简介</a></li>
                <li><a href="../real_data/real_data.php">实时数据</a></li>
                <li><a href="../current_collect/current_collect.php">实时采集</a> </li>
                <li><a href="../data_entry/data_entry.php">数据录入</a> </li>
            </ul>
        </div>
        <div class="exchange_div">
            <div id="sz_query">
                <div class="bar">
                    <p><a href="../../main_page/inform.php"><img src="../../../image/home.png"> </a><a href="../../unit_query/unit_intro/unit_intro.php">单位查询</a><a>单位简介</a></p>
                </div>
            </div>
            <div class="content">
                <div class="unit_intro">
                    <div class="ui_div1">
                        <div class="left">
                            <img id="image" src=""/>
                        </div>
                        <div class="ui_div2" >
                            <table>
                                <tr>
                                    <td><p>企业名称：</p><input id="name" value="" /></td>
                                    <td><p>企业法人：</p><input id="legal_person" value="" /></td>
                                </tr>
                                <tr>
                                    <td><p>组织机构代码：</p><input style="background: #f9f9f9" id="org_code" value="" readonly="true"/></td>
                                    <td><p>营业执照注册号：</p><input id="lic_number" value="" /></td>
                                </tr>
                                <tr>
                                    <td><p>单位注册地址：</p><input id="reg" value="" /></td>
                                    <td><p>单位生产地址：</p><input id="pro" value="" /></td>
                                </tr>
                                <tr>
                                    <td><p>一级行业：</p><select id="industry_type">
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
                                        </select></td>
                                    <td><p>二级行业：</p><select id="second_industry_type">
                                        </select></td>
                                </tr>
                                <tr>
                                    <td><p>所在区域：</p><select id="region">
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
                                        </select></td>
                                    <td><p>产品种类：</p><input style="background: #f9f9f9" value="" readonly="true"/></td>
                                </tr>
                                <tr>
                                    <td><p>单位联系人：</p><input id="business_contact" value="" /></td>
                                    <td><p>联系人号码：</p><input id="contact_num" value="" /></td>
                                </tr>
                                <tr>
                                    <td><p>单位电话：</p><input id="business_phone" value="" /></td>
                                    <td><p>单位传真：</p><input id="fax" value="" /></td>
                                </tr>
                                <tr>
                                    <td><p>邮政编码：</p><input id="zip_code" value="" /></td>
                                    <td><p>E-mail：</p><input id="E-mail" value="" /></td>
                                </tr>

                            </table>
                            <div style="width: 50px; height:50px; display: block; float: left; margin-left: 48%;">
                                <input id="submit" type="button" value="提交" class="btn"/>
                            </div>
                        </div>
                    </div>
                    <div class="ui_div3" >
                        <p>采集点总数：</p>
                        <p><input id="point_num" value="" readonly="true" >个</p>
                        <p>上一日综合能耗当量值：</p>
                        <p><input id="last_energy" value="" readonly="true"> tce</p>
                    </div>
                    <div id="about_enter"></div>
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
<script src="../../../js/sweet-alert.min.js"></script>
<script src="unit_intro.js"></script>
<script src="../../../js/account.js"></script>
<script src="../../../js/logOut.js"></script>
</body>
</html>
