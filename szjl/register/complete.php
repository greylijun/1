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
        .register{background: url("../image/register_bg2.png") no-repeat top center #fff; background-size:  auto 100%;}
        .register table tr td textarea{width:200px; height: 80%; resize: none; font-size: 14px; }
        .register table tr td input{border: none;}
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
            <td><span>*</span>单位照片：</td>
            <td>
                <form id="submit" action="../utils/upload_file.php?file=file" method="post" enctype="multipart/form-data">
                    <input readonly type="file" name="file" id="file"/>
                </form>
                <label>图片名称以组织机构代码命名，390px×260px，小于1M，格式为gif、jpg、png、bmp等</label>
            </td>
            <td><span>*</span>单位简介：</td>
            <td rowspan="5">
                <textarea id="about_enter"></textarea>
                <label>单位简介请保持在330字以内</label>
            </td>
        </tr>
        <tr>
            <td><span>*</span>营业执照图片：</td>
            <td>
                <form id="submit2" action="../utils/upload_file2.php?file2=file2" method="post" enctype="multipart/form-data">
                    <input readonly type="file" name="file2" id="file2"/>
                </form>
                <label>图片名称以营业执照命名，格式为gif、jpg、png、bmp等</label>
            </td>
        </tr>
        <tr>
            <td><span>*</span>所在区域：</td>
            <td>
                <select id="region">
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
            </td>
        </tr>
        <tr>
            <td><span>*</span>一级行业：</td>
            <td>
                <select id="industry_type">
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
            </td>
        </tr>
        <tr>
            <td><span>*</span>二级行业：</td>
            <td>
                <select id="second_industry_type">
                </select>
            </td>
        </tr>
        <tr>
            <td><span>*</span>用能单位类型：</td>
            <td>
                <select id="unit_industry_type">
                    <option>工业企业</option>
                    <option>公共机构</option>
                </select>
            </td>
        </tr>
    </table>
    <label>
        <div style="width: 150px; height: 50px; float: left; overflow: hidden; margin: 50px 0 0 35%; text-align: center; display: block;">
            <input id="button3" value="上一步" class="btn" readonly type="button" style="width: 75px; text-align: center; margin: 0; float: none;">
        </div>
        <div style="width: 150px; height: 50px; float: left; overflow: hidden; margin-top:50px; text-align: center; display: block;">
            <input id="button4" value="提交" class="btn" readonly type="button" style="width: 75px; text-align: center; margin: 0; float: none;">
        </div>
    </label>
</div>
</body>
<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/jquery.form.js"></script>
<script src="../js/sweet-alert.min.js"></script>
<script src="complete_info.js"></script>

</html>
