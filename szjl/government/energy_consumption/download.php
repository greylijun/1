<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>苏州市用能单位能源计量数据在线采集系统</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/sweet-alert.css">
    <style>
        .menu ul li{ width: 50%;}

    </style>
</head>
<?php
session_start();
if(!isset($_SESSION['government_tsn'])){
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
                <li><a href="../main_page/">首页</a></li>
                <li><a href="../energy_map/">能源地图</a></li>
                <li><a href="../data_query/">数据查询</a></li>
                <li><a href="../unit_query/">单位查询</a></li>
                <li><a href="../equipment_query/">设备查询</a></li>
                <li><a class="active" href="../energy_consumption">能耗限额</a></li>
                <li><a href="../communication/">意见交流</a> </li>
                <li><a href="../contact_us/">联系我们</a></li>
            </ul>
        </nav>
    </header>
    <main role="main">
        <div class="menu">
            <ul>
                <li><a href="index.php">限额查询</a></li>
                <li class="on"><a href="download.php">资料下载</a></li>
            </ul>
        </div>
        <div class="exchange_div">
            <div id="mp_3">
                <div class="bar">
                    <p><a href="../main_page/"><img src="../../image/home.png"> </a><a href="../main_page/">首页</a><a>资料下载</a></p>
                </div>
                <div class="content">
                    <br/>
                    <div id="mp3_page1">
                        <table class="tab">
                            <tr>
                                <td>江苏省工业用水定额（2010年修订）</td>
                                <td><a href="document/1.rar">【下载】</a></td>
                            </tr>
                            <tr>
                                <td>《吨钢可比能耗额和电炉钢冶炼电耗限额及计算方法》</td>
                                <td><a href="document/2.rar">【下载】</a></td>
                            </tr>
                            <tr>
                                <td>GB 21341-2008铁合金单位产品能源消耗限额</td>
                                <td><a href="document/3.rar">【下载】</a></td>
                            </tr>
                            <tr>
                                <td>取水定额 第1部分：火力发电</td>
                                <td><a href="document/4.rar">【下载】</a></td>
                            </tr>
                            <tr>
                                <td>取水定额 第2部分：钢铁联合企业</td>
                                <td><a href="document/5.rar">【下载】</a></td>
                            </tr>
                            <tr>
                                <td>取水定额 第3部分：石油炼制</td>
                                <td><a href="document/6.rar">【下载】</a></td>
                            </tr>
                            <tr>
                                <td>取水定额 第4部分：棉印染产品</td>
                                <td><a href="document/7.rar">【下载】</a></td>
                            </tr>
                            <tr>
                                <td>取水定额 第5部分：造纸产品</td>
                                <td><a href="document/8.rar">【下载】</a></td>
                            </tr>
                            <tr>
                                <td>取水定额 第6部分：啤酒制造</td>
                                <td><a href="document/9.rar">【下载】</a></td>
                            </tr>
                            <tr>
                                <td>取水定额 第7部分：酒精制造</td>
                                <td><a href="document/10.rar">【下载】</a></td>
                            </tr>
                            <tr>
                                <td>GB 21343-2008 电石单位产品能源消耗限额</td>
                                <td><a href="document/11.rar">【下载】</a></td>
                            </tr>
                            <tr>
                                <td>GB-T_12723-2008_单位产品能源消耗限额编制通则</td>
                                <td><a href="document/12.rar">【下载】</a></td>
                            </tr>
                            <tr>
                                <td>关于印发《江苏省城市生活与公共用水定额（2012年修订）》的通知（1）</td>
                                <td><a href="document/13.rar">【下载】</a></td>
                            </tr>
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
<script src="../../js/account.js"></script>
<script src="../../js/sweet-alert.min.js"></script>
<script src="../../js/logOut.js"></script>
</body>
</html>
