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
        .menu ul li{ width: 50%;}
        .menu ul li.on a::after{margin-left: -80px;}
        .table tr:nth-child(n+2) td{ height: 55px;}
        .table tr td:nth-child(4){ width: 25%;}
        .table tr td textarea{ resize: none; border: 1px solid #ccc; width: 100%; outline: none;font-size: 13px;}
        .table tr td input{height: 25px; border: 1px solid #ccc; width: 60%; outline: none; text-align: left; text-indent: 3px; font-size: 13px;}
        .table tr td:nth-child(3) input{ border: none; width: 200px;}
        .table tr td:last-child div{width: 70px; height: 35px; margin: 0 auto; overflow: hidden;}
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
                <li><a class="active" href="../information_release/">信息发布</a></li>
                <li><a href="../view_communication/">意见交流</a></li>
                <li><a href="../data_revise/">数据修正</a></li>
                <li><a href="../site_operation/">现场施工</a></li>
            </ul>
        </nav>
    </header>

    <main role="main">
        <div class="menu">
            <ul>
                <li><a href="index.php">平台通知（预览）</a></li>
                <li class="on"><a href="inform.php">平台通知（发布）</a></li>
            </ul>
        </div>
        <div class="exchange_div">
            <div class="bar">
                <p><a href="../main_page/"><img src="../../image/home.png"> </a><a href="../contact_us/">信息发布</a><a>平台通知（发布）</a></p>
            </div>
            <div class="content">

                <div id="focus_Box">
                    <span class="prev">&nbsp;</span>
                    <span class="next">&nbsp;</span>
                    <ul>
                        <li>
                            <a href="#"><img  height="308" alt="Photo sharing jq22" src="../../image/a1.jpg" /></a>
                        </li>
                        <li>
                            <a href="#"><img  height="308" alt="Photo sharing jq22" src="../../image/a6.jpg" /></a>
                        </li>
                        <li>
                            <a href="#"><img  height="308" alt="Photo sharing jq22" src="../../image/a3.jpg" /></a>
                        </li>
                        <li>
                            <a href="#"><img  height="308" alt="Photo sharing" src="../../image/a4.jpg" /></a>
                        <li>
                            <a href="#"><img  height="308" alt="Photo sharing jq22" src="../../image/a7.jpg" /></a>
                        </li>
                    </ul>
                </div>
                <form  action="inform_insert.php" enctype="multipart/form-data" method="post">
                <table class="table" >
                    <tr>
                        <td>通过名称</td>
                        <td>通过日期</td>
                        <td>上传图片</td>
                        <td>通知内容</td>
                        <td>发布单位</td>
                        <td>操作</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="name" id="name"></td>
                        <td><input class="laydate-icon" onclick="laydate()" id="date" name="date"></td>
                        <td><input type="file" name="pic" ></td>                        
                        <td><textarea id="content" name="content"></textarea></td>
                        <td><input type="text" name="unit" id="unit"></td>
                        <td>
                            <div>
                                <input value="添加" class="btn" id="submit" type="submit"  readonly >
                        </td>
                        <td>
                                <input value="重置" class="btn" id="reset" type="reset"  readonly >
                           </div>
                        </td>
                    </tr>
                    <!--<tr>
                        <td><input></td>
                        <td><input class="laydate-icon" onclick="laydate()"></td>
                        <td><input type="file"></td>
                        <td><textarea></textarea></td>
                        <td><input></td>
                        <td>
                            <div>
                                <input class="btn" value="删除" readonly style=" height: 18px;" >
                            </div>
                        </td>
                    </tr>-->
                </table>
                </form>
                <div class="page">
                    <!--分页-->
                </div>
                <!--<div style="width: 60px; height: 30px; overflow: hidden; float: left; margin:8px 20px 0 45%">
                    <input readonly value="添加" class="btn">
                </div>
                <div style="width: 60px; height: 30px; overflow: hidden; float: left; margin-top: 8px;">
                    <input readonly value="提交" class="btn">
                </div>-->
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
<script src="../../js/sweet-alert.min.js"></script>
<script src="../../js/logOut.js"></script>
<script src="../../js/highcharts.js"></script>
<script src="../../js/ZoomPic.js"></script>
<script src="../../js/laydate/laydate.js"></script>
<script src="../../js/account.js"></script>
<!--<script src="inform_insert.js"></script>-->
</body>
</html>
