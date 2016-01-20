<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>苏州市用能单位能源计量数据在线采集系统</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../style/style.css">
    <link rel="stylesheet" href="../../../style/sweet-alert.css">
    <style>
        .menu ul li{ width: 50%;}
        .equip_query .div1>ul{width: 1170px;}
    </style>
</head>
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
                <li><a href="../../main_page/">首页</a></li>
                <li><a href="../../energy_map/">能源地图</a></li>
                <li><a href="../../data_query/">数据查询</a></li>
                <li><a href="../../unit_query/">单位查询</a></li>
                <li><a class="active" href="../../equipment_query/">设备查询</a></li>
                <li><a href="../../energy_consumption">能耗限额</a></li>
                <li><a href="../../communication/">意见交流</a></li>
                <li><a href="../../contact_us/">联系我们</a></li>
            </ul>
        </nav>
    </header>
    <main role="main">
        <div class="menu">
            <ul>
                <li><a href="../index.php">日志查询</a></li>
                <li class="on"><a href="detail_query.php">明细查询</a></li>
            </ul>
        </div>
        <div class="exchange_div">
            <div class="bar">
                <p><a href="../../main_page/"><img src="../../../image/home.png"> </a><a href="../../equipment_query/">设备查询</a><a>明细查询</a></p>
            </div>
            <div class="content">
                <div class="equip_query">
                    <div class="div1">
                        <label>
                            能源计量通讯模块一览表
                        </label>
                        <ul>
                            <li>
                                <p>地区类型：</p>
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
                                <p>行业类型：</p>
                                <select id="industry">
                                    <option>全行业</option>
                                    <option>医药</option>
                                    <option>建筑</option>
                                    <option>冶金</option>
                                    <option>化工</option>
                                    <option>机械</option>
                                    <option>电子</option>
                                    <option>信息</option>
                                    <option>交通</option>
                                    <option>其他</option>
                                </select>
                            </li>
                            <li>
                                <p>单位名称：</p>
                                <select id="enter_name">
                                </select>
                            </li>
                            <li>
                                <p>资源类型：</p>
                                <select id="source_type">
                                    <option>所有资源</option>
                                    <option>煤</option>
                                    <option>油</option>
                                    <option>天然气</option>
                                    <option>冷量</option>
                                    <option>电</option>
                                    <option>蒸汽</option>
                                    <option>水</option>
                                </select>
                            </li>
                            <li>
                                <p>表的编号：</p>
                                <input id="table_id" />
                            </li>
                            <li style="width: 75%;">
                                <p>当前企业已存在的采集点表编号：</p>
                                <div id="con">
                                    <div class="bottomcover" style="z-index: 2;"></div>
                                    <ul id="point_number">
                                    </ul>
                                </div>
                                </li>
                        </ul>
                        <div style="width: 100px; height: 30px; margin-left: 48%; overflow: hidden">
                            <input id="query" class="btn" value="查询" readonly style="width: 30px;"/>
                        </div>
                    </div>
                    <div class="table">
                        <table>
                            <tr>
                                <td>序号</td>
                                <td>所在区域</td>
                                <td>行业类型</td>
                                <td>单位名称</td>
                                <td>表的编号</td>
                                <td>资源类型</td>
                                <td>表的等级</td>
                                <td>当量系数</td>
                                <td>等价系数</td>
                            </tr>
                            <tbody id="query_table"></tbody>
                        </table>
                    </div>
                    <div class="page"></div>
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
<script type="text/javascript" src="../../../js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../../../js/jPages.js"></script>
<script type="text/javascript" src="../../../js/utils.js"></script>
<script type="text/javascript" src="../../../js/sweet-alert.min.js"></script>
<script type="text/javascript" src="../../../js/logOut.js"></script>
<script type="text/javascript" src="detail_query.js"></script>
<script type="text/javascript" src="../../../js/jquery.pause.min.js"></script>
<script type="text/javascript" src="../../../js/weiboscroll.js"></script>
<script src="../../../js/account.js"></script>
</html>
