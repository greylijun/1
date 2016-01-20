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
        .menu ul li{ width: 100%;}
        .menu ul li.on a::after{margin-left: -100px;}
        .bar p a{width: 200px;}
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
                <li><a href="../energy_consumption">能耗限额</a></li>
                <li><a href="../communication/">意见交流</a> </li>
                <li><a class="active" href="../contact_us/">联系我们</a></li>
            </ul>
        </nav>
    </header>
    <main role="main">
        <div class="menu">
            <ul>
                <li class="on"><a href="index.php">苏州市计量测试研究所</a> </li>
            </ul>
        </div>
        <div class="exchange_div">
            <div class="bar">
                <p><a href="../main_page/"><img src="../../image/home.png"> </a><a href="../contact_us/">联系我们</a><a>苏州市计量测试研究所</a></p>
            </div>
            <div class="content" style="background: #eee;">
                <div class="contact_us">
                    <div class="div1">
                        <div style="width:98%;height:95%;none;font-size:12px; margin: 1%" id="map"></div>
                    </div>
                    <div class="div2">
                        <ul>
                            <li><a href="http://www.szjl.com.cn/contact/88d3bb3470c77be5bc6d1efb03e77c59.html" title="苏州市计量测试研究所（本部）" target="_blank"><span>&nbsp;</span>1 苏州市计量测试研究所（本部）</a></li>
                            <li><a href="http://www.szjl.com.cn/contact/1327d23d0ae8da0677bbddd0f8cbbfec.html" title="苏州高新区计量技术研究所（业务窗口）" target="_blank"><span>&nbsp;</span>2 苏州市高新区计量测试研究所（业务窗口）</a></li>
                            <li><a href="http://www.szjl.com.cn/contact/af20f65d12a308388a733ebc2c494e38.html" title="苏州市计量测试研究所园区校准所（业务窗口）" target="_blank"><span>&nbsp;</span>3 苏州市计量测试研究所园区校准所（业务窗口）</a></li>
                            <li><a href="http://www.szjl.com.cn/contact/6bc4b70b67003f8ee568b153ec669802.html" title="苏州市计量测试研究所相城办事处" target="_blank"><span>&nbsp;</span>4 苏州市计量测试研究所相城办事处</a></li>
                            <li><a href="http://www.szjl.com.cn/contact/457cecb12377c5fc04fa74ce8c3370f0.html" title="苏州市计量测试研究所园区实验室业务窗口" target="_blank"><span>&nbsp;</span>5 苏州市计量测试研究所园区实验室业务窗口</a></li>
                            <li><a href="http://www.szjl.com.cn/contact/f36daf3f61090515cebfad13fa3e0e33.html" title="苏州计量测试研究所新区实验室业务窗口" target="_blank"><span>&nbsp;</span>6 苏州市计量测试研究所新区实验室业务窗口</a></li>
                        </ul>
                    </div>
                    <div style="clear: both"></div>
                    <div class="div3">

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
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
<script type="text/javascript">
    //创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
        addMapOverlay();//向地图添加覆盖物
    }
    function createMap(){
        map = new BMap.Map("map");
        map.centerAndZoom(new BMap.Point(120.657099,31.304155),12);
    }
    function setMapEvent(){
        map.enableScrollWheelZoom();
        map.enableKeyboard();
        map.enableDragging();
        map.enableDoubleClickZoom()
    }
    function addClickHandler(target,window){
        target.addEventListener("click",function(){
            target.openInfoWindow(window);
        });
    }
    function addMapOverlay(){
        var markers = [
            {content:"",title:"苏州市计量测试研究所（本部）",imageOffset: {width:0,height:3},position:{lat:31.273049,lng:120.643876}},
            {content:"",title:"苏州市高新区计量测试研究所（业务窗口）",imageOffset: {width:0,height:3},position:{lat:31.296256,lng:120.560513}},
            {content:"",title:"苏州市计量测试研究所园区校准所（业务窗口）",imageOffset: {width:0,height:3},position:{lat:31.341666,lng:120.777831}},
            {content:"",title:"苏州市计量测试研究所相城办事处",imageOffset: {width:0,height:3},position:{lat:31.377682,lng:120.645601}},
            {content:"",title:"苏州市计量测试研究所园区实验室业务窗口",imageOffset: {width:0,height:3},position:{lat:31.376202,lng:120.736437}},
            {content:"",title:"苏州市计量测试研究所新区实验室业务窗口",imageOffset: {width:0,height:3},position:{lat:31.337718,lng:120.438631}}
        ];
        for(var index = 0; index < markers.length; index++ ){
            var point = new BMap.Point(markers[index].position.lng,markers[index].position.lat);
            var marker = new BMap.Marker(point,{icon:new BMap.Icon("http://api.map.baidu.com/lbsapi/createmap/images/icon.png",new BMap.Size(20,25),{
                imageOffset: new BMap.Size(markers[index].imageOffset.width,markers[index].imageOffset.height)
            })});
            var label = new BMap.Label(markers[index].title,{offset: new BMap.Size(25,5)});
            var opts = {
                width: 200,
                title: markers[index].title,
                enableMessage: false
            };
            var infoWindow = new BMap.InfoWindow(markers[index].content,opts);
            marker.setLabel(label);
            addClickHandler(marker,infoWindow);
            map.addOverlay(marker);
        };
    }
    //向地图添加控件
    function addMapControl(){
        var scaleControl = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
        scaleControl.setUnit(BMAP_UNIT_IMPERIAL);
        map.addControl(scaleControl);
        var navControl = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
        map.addControl(navControl);
        var overviewControl = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:true});
        map.addControl(overviewControl);
    }
    var map;
    initMap();
</script>
</body>
</html>
