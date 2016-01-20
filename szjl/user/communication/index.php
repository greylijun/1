

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
        .menu ul li{ width: 50%;}
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
                <li><a href="../main_page/inform.php">首页</a></li>
                <li><a href="../data_query/">数据查询</a></li>
                <li><a href="../unit_query/unit_intro/unit_intro.php">单位查询</a></li>
                <li><a href="../equipment_query/">设备查询</a></li>
                <li><a href="../energy_consumption">能耗限额</a></li>
                <li><a class="active" href="../communication/">意见交流</a></li>
                <li><a href="../contact_us/">联系我们</a></li>
            </ul>
        </nav>
    </header>
    <main role="main">
        <div class="menu">
            <ul>
                <li class="on"><a href="index.php">意见反馈</a></li>
                <li><a href="history/index.php">历史意见</a></li>
            </ul>
        </div>
        <div class="exchange_div">
            <div class="bar">
                <p><a href="../main_page/inform.php"><img src="../../image/home.png"> </a><a href="../communication/">意见交流</a><a>意见反馈</a></p>
            </div>
             

            <div class="content">
                <div class="communication">
                    <ul>
                        <li>
                            <label>联系人：</label>
                            <input type="text" id="username" value="" readonly></li>
                        </li>
                        <li>
                            <label>手机号码：</label>
                            <input type="text" id="tel" value="" readonly></li>
                        </li>
                        <li>
                            <label>邮箱：</label>
                            <input type="text" id="email" value="" readonly></li>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <label>主题：</label>
                            <input type="text" id="theme" name="theme">
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <label>
                                正文：
                            </label>
                        </li>
                    </ul>
                    <textarea name="question" id="question" ></textarea>
                    <div style="width: 100%; height: 40px;">
                        <input value="提交" class="btn"  readonly style=" width: 60px; margin-left: 50%;" type="button" id="submit">
                    </div>

                </div>
            </div>
            </form>
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
<script src="../../js/logOut.js"></script>
<script src="feedback.js"></script>
<script src="../../js/account.js"></script>
</body>
</html>
