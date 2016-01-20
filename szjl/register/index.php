<!doctype html>
<?php
//session_start();
?>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>苏州市用能单位能源计量数据在线采集系统</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/sweet-alert.css">
    <style>
        header{height: 55px;}
    </style>
</head>
<body>
    <header role="banner">
        <label>
            <p>苏州市用能单位能源计量数据在线采集系统</p>
            <p>&nbsp;</p>
        </label>
    </header>
    <div class="register">
        <table>
            <tr>
                <td><span>*</span>单位名称：</td>
                <td>
                    <input id="enter_name" value=""/>
                </td>
                <td><span>*</span>单位法人：</td>
                <td><input id="legal_person"></td>
            </tr>
            <tr>
                <td><span>*</span>单位注册地址：</td>
                <td><input id="registered_address"></td>
                <td><span>*</span>单位生产地址：</td>
                <td><input id="production_address"></td>
            </tr>
            <tr>
                <td><span>*</span>营业执照注册号：</td>
                <td><input id="license_registration_number"></td>
                <td><span>*</span>组织机构代码：</td>
                <td><input id="organization_code"></td>
            </tr>
            <tr>
                <td><span>*</span>单位电话：</td>
                <td><input id="business_phone"></td>
                <td><span>*</span>E-mail：</td>
                <td><input id="E_mail"></td>
            </tr>
            <tr>
                <td><span>*</span>邮政编码：</td>
                <td><input id="zip_code"></td>
                <td><span>&nbsp;</span>单位传真：</td>
                <td><input id="fax"></td>
            </tr>
            <tr>
                <td><span>*</span>单位联系人：</td>
                <td><input id="business_contacts"></td>
                <td><span>*</span>联系人号码：</td>
                <td><input id="contact_number"></td>
            </tr>
        </table>
            <div style="width: 150px; height: 50px; float: left; overflow: hidden; margin: 50px 0 0 35%; text-align: center; display: block;">
                <input id="button1" value="上一步" class="btn" readonly type="button" style="width: 75px;">
            </div>
            <div style="width: 150px; height: 50px; float: left; overflow: hidden; margin-top:50px; text-align: center; display: block;">
                <input id="button2" value="下一步" class="btn" readonly type="button" style="width: 75px;">
            </div>
    </div>
</body>
<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/jquery.form.js"></script>
<script src="../js/sweet-alert.min.js"></script>
<script src="complete_info.js"></script>
</html>
