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
    <script src="../../js/jquery-1.11.1.min.js"></script>
    <script src="../../js/sweet-alert.min.js"></script>
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
                <li><a class="active" href="../information_check/">信息审核</a></li>
                <li><a href="../information_release/">信息发布</a></li>
                <li><a href="../view_communication/">意见交流</a></li>
                <li><a href="../data_revise/">数据修正</a></li>
                <li><a href="../site_operation/">现场施工</a></li>
            </ul>
        </nav>
    </header>
    <main role="main">
        <div class="menu">
            <ul>
                <li class="on"><a href="index.php">信息概括</a></li>
                <li><a href="consumption_check/consumption_check.php">限额审核</a></li>
                <li><a href="register_check/register_check.php">注册审核</a></li>
                <li><a href="data_check/data_check.php">数据录入审核</a></li>
            </ul>
        </div>
        <div class="exchange_div">
            <div class="bar">
                <p><a href="../information_check/"><img src="../../image/home.png"> </a><a href="../information_check/">信息审核</a><a>信息概括</a></p>
            </div>
            <div class="content">
                <div class="information_summarize">
                    <div class="div1">
                        <div class="div">
                            <label>
                                <a href="register_check/register_check.php">注册审核概况</a>
                            </label>
                            <table>
                                <tr>
                                    <td>已注册单位：</td>
                                    <td><input id="register" value="" readonly> 家</td>
                                </tr>
                                <tr>
                                    <td>审核通过单位：</td>
                                    <td><input id="pass_review" value="" readonly>家</td>
                                </tr>
                                <tr>
                                    <td>审核未通过单位：</td>
                                    <td><input id="no_pass_review" value="" readonly>家</td>
                                </tr>
                                <tr>
                                    <td>未审核单位：</td>
                                    <td><input id="no_review" value="" readonly>家</td>
                                </tr>
                            </table>
                        </div>
                        <div style="clear: both"></div>
                        <div style="width: 100px; height: 100px; float: right; top:-60px; position: relative; border-right: 1px solid #f8b551;border-bottom: 1px solid #f8b551; font-size: 16px;text-indent: 70px;line-height: 150px">
                            1
                        </div>
                    </div>
                    <div class="div2">
                        <div class="div">
                            <label>
                                <a href="consumption_check/consumption_check.php">限额审核概况</a>
                            </label>
                            <table>
                                <tr>
                                    <td>今年已提交单位：</td>
                                    <td><input id="Limit_commit" value="" readonly>家</td>
                                </tr>
                                <tr>
                                    <td>今年未提交单位：</td>
                                    <td><input id="Limit_no_commit" value="" readonly>家</td>
                                </tr>
                                <tr>
                                    <td>未通过审核单位：</td>
                                    <td><input id="limit_no_pass" value="" readonly>家</td>
                                </tr>
                                <tr>
                                    <td>通过审核单位：</td>
                                    <td><input id="limit_pass" value="" readonly>家</td>
                                </tr>
                                <tr>
                                    <td>未审核单位：</td>
                                    <td><input id="limit_no_review" value="" readonly>家</td>
                                </tr>
                            </table>
                        </div>
                        <div style="clear: both"></div>
                        <div style="width: 100px; height: 100px; float: left; top: -60px;  position: relative; border-left: 1px solid #f8b551;border-bottom: 1px solid #f8b551; font-size: 16px;text-indent: 20px;line-height: 150px">
                            3
                        </div>
                    </div>
                    <div class="div3">
                        <div class="div">
                            <label>
                                <a href="../view_communication/">意见交流概况</a>
                            </label>
                            <table>
                                <tr>
                                    <td>企业提出意见：</td>
                                    <td><input id="question_num" value="" readonly>次</td>
                                </tr>
                                <tr>
                                    <td>已回复意见：</td>
                                    <td><input id="answer_num" value="" readonly>次</td>
                                </tr>
                                <tr>
                                    <td>未回复意见：</td>
                                    <td><input id="answer_no_num" value="" readonly>次</td>
                                </tr>
                            </table>
                        </div>
                        <div style="clear: both"></div>
                        <div style="width: 100px; height: 100px; float: right; top:-242px; position: relative; border-right: 1px solid #f8b551;border-top: 1px solid #f8b551; font-size: 16px;text-indent: 70px;line-height: 100px">
                            2
                        </div>
                    </div>
                    <div class="div4">
                        <div class="div">
                            <label>
                                <a href="data_check/data_check.php">数据录入审核</a>
                            </label>
                            <table>
                                <tr>
                                    <td>审核通过单位：</td>
                                    <td><input id="no_verification" value="" readonly>家</td>
                                </tr>
                                <tr>
                                    <td>审核未通过单位：</td>
                                    <td><input id="no_pass_verification" value="" readonly>家</td>
                                </tr>
                                <tr>
                                    <td>未审核单位：</td>
                                    <td><input id="pass_verification" value="" readonly>家</td>
                                </tr>
                            </table>
                        </div>
                        <div style="clear: both"></div>
                        <div style="width: 100px; height: 100px; float: left; top:-242px; position: relative; border-left: 1px solid #f8b551;border-top: 1px solid #f8b551; font-size: 16px;text-indent: 20px;line-height: 100px">
                            4
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
<script src="../../js/laydate/laydate.js"></script>
<script src="../../js/logOut.js"></script>
<script src="../../js/account.js"></script>
<script src="information_check.js"></script>
</body>
</html>
