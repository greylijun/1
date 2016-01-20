/**
 * Created by LiJun on 2015/11/3.
 */
function yuanqu1(){
    var map = new BMap.Map("energy_consumption");
    map.centerAndZoom(new BMap.Point(120.76178,31.3327),12);
    map.disableScrollWheelZoom(true);
    $.getJSON('energy_consumption/energy_consumption.php',{
        area:"园区"
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
    var plPoints = [{points:["120.829681|31.380905","120.826232|31.39077","120.827382|31.403099","120.825082|31.407537","120.825082|31.415427","120.822782|31.425781","120.822207|31.430711","120.818758|31.432683","120.814158|31.434655","120.80496|31.435148","120.795186|31.435148","120.780813|31.431204","120.768165|31.422329","120.757242|31.419371","120.748043|31.410496","120.741144|31.406551","120.73712|31.398661","120.73712|31.392743","120.73367|31.391263","120.725047|31.391263","120.713548|31.38929","120.692276|31.378439","120.684803|31.370053","120.675604|31.366106","120.668705|31.364133","120.656632|31.351798","120.645708|31.349331","120.646283|31.342423","120.650308|31.333047","120.653757|31.327618","120.655482|31.320708","120.660081|31.309849","120.661231|31.300963","120.662381|31.295039","120.660081|31.286645","120.666405|31.287633","120.675029|31.282695","120.676754|31.291089","120.688827|31.278745","120.693426|31.276276","120.6986|31.275288","120.704925|31.264424","120.708374|31.261954","120.715273|31.256521","120.718148|31.256027","120.723897|31.256027","120.724472|31.254546","120.73252|31.243185","120.742294|31.241703","120.749768|31.236269","120.759542|31.233304","120.76759|31.239233","120.770465|31.244173","120.795761|31.256521","120.810134|31.265905","120.825082|31.269362","120.83658|31.270844","120.848653|31.266893","120.848079|31.274301","120.852678|31.277757","120.852103|31.286645","120.851528|31.289608","120.860727|31.295532","120.860727|31.299976","120.866476|31.313798","120.868775|31.325644","120.8705|31.331566","120.87165|31.339462","120.865901|31.34341","120.861302|31.348344","120.865326|31.362159","120.854977|31.366106","120.843479|31.36808","120.839455|31.376466","120.830256|31.380412"]}];
//向地图中添加线函数
    function addPolyline(){
        for(var i=0;i<plPoints.length;i++){
            var json = plPoints[i];
            var points = [];
            for(var j=0;j<json.points.length;j++){
                var p1 = json.points[j].split("|")[0];
                var p2 = json.points[j].split("|")[1];
                points.push(new BMap.Point(p1,p2));
            }
            var line = new BMap.Polyline(points,{strokeWeight:1,strokeColor:"none"});
            //console.log(points);
            map.addOverlay(line);
            var ply1 = new BMap.Polygon([new BMap.Point(120.829681,31.380905),new BMap.Point(120.826232,31.39077),new BMap.Point(120.827382,31.403099),new BMap.Point(120.825082,31.407537),new BMap.Point(120.825082,31.415427),new BMap.Point(120.822782,31.425781),new BMap.Point(120.822207,31.430711),new BMap.Point(120.818758,31.432683),new BMap.Point(120.814158,31.434655),new BMap.Point(120.80496,31.435148),new BMap.Point(120.795186,31.435148),new BMap.Point(120.780813,31.431204),new BMap.Point(120.768165,31.422329),new BMap.Point(120.757242,31.419371),new BMap.Point(120.748043,31.410496),new BMap.Point(120.741144,31.406551),new BMap.Point(120.73712,31.398661),new BMap.Point(120.73712,31.392743),new BMap.Point(120.73367,31.391263),new BMap.Point(120.725047,31.391263),new BMap.Point(120.713548,31.38929),new BMap.Point(120.692276,31.378439),new BMap.Point(120.684803,31.370053),new BMap.Point(120.675604,31.366106),new BMap.Point(120.668705,31.364133),new BMap.Point(120.656632,31.351798),new BMap.Point(120.645708,31.349331),new BMap.Point(120.646283,31.342423),new BMap.Point(120.650308,31.333047),new BMap.Point(120.653757,31.327618),new BMap.Point(120.655482,31.320708),new BMap.Point(120.660081,31.309849),new BMap.Point(120.661231,31.300963),new BMap.Point(120.662381,31.295039),new BMap.Point(120.660081,31.286645),new BMap.Point(120.666405,31.287633),new BMap.Point(120.675029,31.282695),new BMap.Point(120.676754,31.291089),new BMap.Point(120.688827,31.278745),new BMap.Point(120.693426,31.276276),new BMap.Point(120.6986,31.275288),new BMap.Point(120.704925,31.264424),new BMap.Point(120.708374,31.261954),new BMap.Point(120.715273,31.256521),new BMap.Point(120.718148,31.256027),new BMap.Point(120.723897,31.256027),new BMap.Point(120.724472,31.254546),new BMap.Point(120.73252,31.243185),new BMap.Point(120.742294,31.241703),new BMap.Point(120.749768,31.236269),new BMap.Point(120.759542,31.233304),new BMap.Point(120.76759,31.239233),new BMap.Point(120.770465,31.244173),new BMap.Point(120.795761,31.256521),new BMap.Point(120.810134,31.265905),new BMap.Point(120.825082,31.269362),new BMap.Point(120.83658,31.270844),new BMap.Point(120.848653,31.266893),new BMap.Point(120.848079,31.274301),new BMap.Point(120.852678,31.277757),new BMap.Point(120.852103,31.286645),new BMap.Point(120.851528,31.289608),new BMap.Point(120.860727,31.295532),new BMap.Point(120.860727,31.299976),new BMap.Point(120.866476,31.313798),new BMap.Point(120.868775,31.325644),new BMap.Point(120.8705,31.331566),new BMap.Point(120.87165,31.339462),new BMap.Point(120.865901,31.34341),new BMap.Point(120.861302,31.348344),new BMap.Point(120.865326,31.362159),new BMap.Point(120.854977,31.366106),new BMap.Point(120.843479,31.36808),new BMap.Point(120.839455,31.376466),new BMap.Point(120.830256,31.380412),new BMap.Point(120.830258,31.380416),new BMap.Point(120.829683,31.380905),new BMap.Point(122.038092,-37.718503),new BMap.Point(159.277671,20.629258),new BMap.Point(162.132701,53.334391),new BMap.Point(111.03076,70.283683),new BMap.Point(-3.778721,60.825021),new BMap.Point(-2.799065,-1.750758),new BMap.Point(122.038092,-37.718503)],{strokeColor:"none",fillColor:"rgb(79,79,79)",strokeOpacity:1});
            map.addOverlay(ply1);
            var polygon = new BMap.Polygon(points,{strokeColor:"#da6b19", strokeWeight:3,fillColor:""});  //创建多边形
            map.addOverlay(polygon);   //增加多边形
            //map.setViewport(polygon.getPath());
        }
    }
    initMap();
}
function isSupportCanvas(){
    var elem = document.createElement('canvas');
    return !!(elem.getContext && elem.getContext('2d'));
}