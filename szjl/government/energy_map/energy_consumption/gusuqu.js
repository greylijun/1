/**
 * Created by LiJun on 2015/11/3.
 */
function gusuqu1(){
    var map = new BMap.Map("energy_consumption");
    map.centerAndZoom(new BMap.Point(120.59178,31.3227),13);
    map.disableDoubleClickZoom();
    map.disableScrollWheelZoom(true);
    $.getJSON('energy_consumption/energy_consumption.php',{
        area:"姑苏区"
    },function(json){
        var dd = [];
        for(var i=0;i<json.length;i++){
            var data = json[i];
            //console.log(data);
            var sum_max = data.sum_max;
            var sum_indiff_daily = data.sum_indiff_daily;
            var longitude = data.longitude;
            var latitude = data.latitude;
            var points = {"lng":longitude,"lat":latitude,"count":sum_indiff_daily};
            dd[i] = points;
        }
        //console.log(sum_max);
        heatmapOverlay = new BMapLib.HeatmapOverlay({"radius":20});
        map.addOverlay(heatmapOverlay);
        heatmapOverlay.setDataSet({data:dd,max:sum_max});
        //是否显示热力图
        heatmapOverlay.show();
        //console.log(dd);
    });
    if(!isSupportCanvas()){
        alert('热力图目前只支持有canvas支持的浏览器,您所使用的浏览器不能使用热力图功能~')
    }

    function initMap(){
        addMapControl();//向地图添加控件
        addPolyline();//向地图中添加线
    }
//地图控件添加函数：
    function addMapControl(){
        //向地图中添加缩放控件
        map.addControl(new BMap.OverviewMapControl());
        map.addControl(new BMap.NavigationControl({
            type: BMAP_NAVIGATION_CONTROL_LARGE,
            anchor: BMAP_ANCHOR_TOP_LEFT,
            offset: new BMap.Size(40, 250)
        }));
    }
//标注线数组
    var gsPoints = [{points:["120.561134|31.384874","120.574645|31.376859","120.580969|31.362799","120.587149|31.361813","120.594192|31.3665","120.612589|31.362553","120.625094|31.352685","120.637311|31.352932","120.646653|31.342446","120.650318|31.33307","120.653839|31.32758","120.655492|31.320485","120.66002|31.309934","120.662248|31.295247","120.659876|31.28673","120.653624|31.288119","120.643419|31.289353","120.637347|31.283799","120.63537|31.28707","120.618087|31.284786","120.614314|31.271237","120.60666|31.270805","120.60684|31.265959","120.599043|31.266083","120.594875|31.268614","120.580933|31.301418","120.562392|31.338344","120.5579|31.338961","120.531203|31.365297","120.561027|31.385059"]}];//姑苏区坐标点
//向地图中添加线函数
    function addPolyline() {
        for (var i = 0; i < gsPoints.length; i++) {
            var json = gsPoints[i];
            var points = [];
            for (var j = 0; j < json.points.length; j++) {
                var p1 = json.points[j].split("|")[0];
                var p2 = json.points[j].split("|")[1];
                points.push(new BMap.Point(p1, p2));
            }
            var ply1 = new BMap.Polygon([new BMap.Point(120.561134,31.384874),new BMap.Point(120.574645,31.376859),new BMap.Point(120.580969,31.362799),new BMap.Point(120.587149,31.361813),new BMap.Point(120.594192,31.3665),new BMap.Point(120.612589,31.362553),new BMap.Point(120.625094,31.352685),new BMap.Point(120.637311,31.352932),new BMap.Point(120.646653,31.342446),new BMap.Point(120.650318,31.33307),new BMap.Point(120.653839,31.32758),new BMap.Point(120.655492,31.320485),new BMap.Point(120.66002,31.309934),new BMap.Point(120.662248,31.295247),new BMap.Point(120.659876,31.28673),new BMap.Point(120.653624,31.288119),new BMap.Point(120.643419,31.289353),new BMap.Point(120.637347,31.283799),new BMap.Point(120.63537,31.28707),new BMap.Point(120.618087,31.284786),new BMap.Point(120.614314,31.271237),new BMap.Point(120.60666,31.270805),new BMap.Point(120.60684,31.265959),new BMap.Point(120.599043,31.266083),new BMap.Point(120.594875,31.268614),new BMap.Point(120.580933,31.301418),new BMap.Point(120.562392,31.338344),new BMap.Point(120.5579,31.338961),new BMap.Point(120.531203,31.365297),new BMap.Point(120.561027,31.385059),new BMap.Point(25.92389,30.942873),new BMap.Point(35.343306,52.80545),new BMap.Point(75.964537,59.964628),new BMap.Point(100.396147,65.909332),new BMap.Point(140.281487,66.089128),new BMap.Point(167.509486,56.635788),new BMap.Point(175.015583,37.887415),new BMap.Point(174.868405,12.915738),new BMap.Point(166.332059,-16.519555),new BMap.Point(112.170417,-24.821626),new BMap.Point(56.095457,-20.866539),new BMap.Point(17.093187,2.506336),new BMap.Point(25.92389,30.942873)],{strokeColor:"none",fillColor:"rgb(79,79,79)",strokeOpacity:1});
            map.addOverlay(ply1);
            var polygon = new BMap.Polygon(points, {strokeColor: "#da6b19", strokeWeight: 3,fillColor:""});  //创建多边形
            map.addOverlay(polygon);   //增加多边形
        }                                                   //姑苏区
    }

    initMap();//创建和初始化地图
}
function isSupportCanvas(){
    var elem = document.createElement('canvas');
    return !!(elem.getContext && elem.getContext('2d'));
}