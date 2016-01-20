/**
 * Created by LiJun on 2015/11/3.
 */
function wuzhongqu1(){
    var map = new BMap.Map("energy_consumption");
    map.centerAndZoom(new BMap.Point(120.39178,31.1757),11);
    map.disableScrollWheelZoom(true);
    $.getJSON('energy_consumption/energy_consumption.php',{
        area:"吴中区"
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
    var plPoints = [{points:["120.86732|31.322749","120.878819|31.309915","120.879825|31.298561","120.884424|31.298314","120.888305|31.288316","120.887658|31.271033","120.902534|31.220648","120.880903|31.213977","120.869117|31.215769","120.856038|31.209036","120.849408|31.196279","120.832322|31.195754","120.824669|31.190781","120.823429|31.179103","120.826016|31.175875","120.801924|31.18763","120.793731|31.19665","120.781945|31.199492","120.780364|31.204804","120.786257|31.214688","120.785539|31.218826","120.768579|31.227843","120.761823|31.227843","120.730203|31.188433","120.72201|31.199677","120.722154|31.206658","120.701529|31.20814","120.690534|31.202519","120.671418|31.199862","120.666747|31.226114","120.657189|31.225002","120.647487|31.228152","120.647487|31.235501","120.639223|31.232104","120.639726|31.217035","120.629377|31.21092","120.629305|31.180463","120.622766|31.177157","120.614286|31.166157","120.603973|31.166991","120.577814|31.118622","120.558411|31.097473","120.502069|31.065309","120.468868|31.030286","120.437391|30.979524","120.377744|30.955496","120.312527|30.937346","120.261491|30.933124","120.202993|30.937585","120.136878|30.950841","120.107282|30.971412","120.059564| 31.011532","120.022326|31.023779","120.021608|31.02415","120.000048|31.039003","119.991329|31.066642","119.980082|31.075145","119.954247|31.110738","119.946013|31.149211","119.931166|31.162007","119.925201|31.172513","120.011834|31.258307","120.105701|31.267823","120.126722|31.274277","120.141046| 31.28374","120.176116|31.322986","120.194807|31.338715","120.242663|31.364066","120.265531|31.391617","120.355469|31.423978","120.367683|31.383964","120.35937|31.380993","120.359347|31.381033","120.370845|31.35797","120.36682|31.349459","120.36912|31.342057","120.364377|31.337246","120.364952|31.324414","120.378894|31.325401","120.376163|31.329535","120.386439|31.332804","120.418204|31.330059","120.426396|31.319756","120.425893|31.314018","120.433259|31.310779","120.435703|31.305194","120.447416|31.306953","120.459705|31.323952","120.482846|31.31735","120.487481|31.299857","120.495638|31.296524","120.50198|31.296663","120.507675|31.30096","120.525147|31.298669","120.533573|31.280045","120.567197|31.279349","120.568621|31.269511","120.564345|31.248073","120.572344|31.244362","120.576296|31.234791","120.594694|31.233864","120.595125|31.257822","120.606982|31.260106","120.606731|31.270817","120.614313|31.271249","120.61805|31.284891","120.635333|31.287174","120.637273|31.283841","120.643418|31.289365","120.659983|31.28668","120.666343|31.287637","120.675038|31.282761","120.676763|31.291093","120.688764|31.278687","120.693579|31.276218","120.718193|31.256032","120.723906|31.256093","120.724481|31.254612","120.732494|31.243251","120.742267|31.241645","120.749777|31.236273","120.759533|31.233278","120.767617|31.239252","120.770456|31.2441","120.795698|31.256526","120.810107|31.26591","120.825091|31.269336","120.836571|31.270894","120.848627|31.266944","120.848088|31.274305","120.852651|31.277823","120.852148|31.286588","120.851501|31.289612","120.8607|31.29998"]}];
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
            var ply1 = new BMap.Polygon([new BMap.Point(120.86732,31.322749),new BMap.Point(120.878819,31.309915),new BMap.Point(120.879825,31.298561),new BMap.Point(120.884424,31.298314),new BMap.Point(120.888305,31.288316),new BMap.Point(120.887658,31.271033),new BMap.Point(120.902534,31.220648),new BMap.Point(120.880903,31.213977),new BMap.Point(120.869117,31.215769),new BMap.Point(120.856038,31.209036),new BMap.Point(120.849408,31.196279),new BMap.Point(120.832322,31.195754),new BMap.Point(120.824669,31.190781),new BMap.Point(120.823429,31.179103),new BMap.Point(120.826016,31.175875),new BMap.Point(120.801924,31.18763),new BMap.Point(120.793731,31.19665),new BMap.Point(120.781945,31.199492),new BMap.Point(120.780364,31.204804),new BMap.Point(120.786257,31.214688),new BMap.Point(120.785539,31.218826),new BMap.Point(120.768579,31.227843),new BMap.Point(120.761823,31.227843),new BMap.Point(120.730203,31.188433),new BMap.Point(120.72201,31.199677),new BMap.Point(120.722154,31.206658),new BMap.Point(120.701529,31.20814),new BMap.Point(120.690534,31.202519),new BMap.Point(120.671418,31.199862),new BMap.Point(120.666747,31.226114),new BMap.Point(120.657189,31.225002),new BMap.Point(120.647487,31.228152),new BMap.Point(120.647487,31.235501),new BMap.Point(120.639223,31.232104),new BMap.Point(120.639726,31.217035),new BMap.Point(120.629377,31.21092),new BMap.Point(120.629305,31.180463),new BMap.Point(120.622766,31.177157),new BMap.Point(120.614286,31.166157),new BMap.Point(120.603973,31.166991),new BMap.Point(120.577814,31.118622),new BMap.Point(120.558411,31.097473),new BMap.Point(120.502069,31.065309),new BMap.Point(120.468868,31.030286),new BMap.Point(120.437391,30.979524),new BMap.Point(120.377744,30.955496),new BMap.Point(120.312527,30.937346),new BMap.Point(120.261491,30.933124),new BMap.Point(120.202993,30.937585),new BMap.Point(120.136878,30.950841),new BMap.Point(120.107282,30.971412),new BMap.Point(120.059564,31.011532),new BMap.Point(120.022326,31.023779),new BMap.Point(120.021608,31.02415),new BMap.Point(120.000048,31.039003),new BMap.Point(119.991329,31.066642),new BMap.Point(119.980082,31.075145),new BMap.Point(119.954247,31.110738),new BMap.Point(119.946013,31.149211),new BMap.Point(119.931166,31.162007),new BMap.Point(119.925201,31.172513),new BMap.Point(120.011834,31.258307),new BMap.Point(120.105701,31.267823),new BMap.Point(120.126722,31.274277),new BMap.Point(120.141046,31.28374),new BMap.Point(120.176116,31.322986),new BMap.Point(120.194807,31.338715),new BMap.Point(120.242663,31.364066),new BMap.Point(120.265531,31.391617),new BMap.Point(120.355469,31.423978),new BMap.Point(120.367683,31.383964),new BMap.Point(120.35937,31.380993),new BMap.Point(120.359347,31.381033),new BMap.Point(120.370845,31.35797),new BMap.Point(120.36682,31.349459),new BMap.Point(120.36912,31.342057),new BMap.Point(120.364377,31.337246),new BMap.Point(120.364952,31.324414),new BMap.Point(120.378894,31.325401),new BMap.Point(120.376163,31.329535),new BMap.Point(120.386439,31.332804),new BMap.Point(120.418204,31.330059),new BMap.Point(120.426396,31.319756),new BMap.Point(120.425893,31.314018),new BMap.Point(120.433259,31.310779),new BMap.Point(120.435703,31.305194),new BMap.Point(120.447416,31.306953),new BMap.Point(120.459705,31.323952),new BMap.Point(120.482846,31.31735),new BMap.Point(120.487481,31.299857),new BMap.Point(120.495638,31.296524),new BMap.Point(120.50198,31.296663),new BMap.Point(120.507675,31.30096),new BMap.Point(120.525147,31.298669),new BMap.Point(120.533573,31.280045),new BMap.Point(120.567197,31.279349),new BMap.Point(120.568621,31.269511),new BMap.Point(120.564345,31.248073),new BMap.Point(120.572344,31.244362),new BMap.Point(120.576296,31.234791),new BMap.Point(120.594694,31.233864),new BMap.Point(120.595125,31.257822),new BMap.Point(120.606982,31.260106),new BMap.Point(120.606731,31.270817),new BMap.Point(120.614313,31.271249),new BMap.Point(120.61805,31.284891),new BMap.Point(120.635333,31.287174),new BMap.Point(120.637273,31.283841),new BMap.Point(120.643418,31.289365),new BMap.Point(120.659983,31.28668),new BMap.Point(120.666343,31.287637),new BMap.Point(120.675038,31.282761),new BMap.Point(120.676763,31.291093),new BMap.Point(120.688764,31.278687),new BMap.Point(120.693579,31.276218),new BMap.Point(120.718193,31.256032),new BMap.Point(120.723906,31.256093),new BMap.Point(120.724481,31.254612),new BMap.Point(120.732494,31.243251),new BMap.Point(120.742267,31.241645),new BMap.Point(120.749777,31.236273),new BMap.Point(120.759533,31.233278),new BMap.Point(120.767617,31.239252),new BMap.Point(120.770456,31.2441),new BMap.Point(120.795698,31.256526),new BMap.Point(120.810107,31.26591),new BMap.Point(120.825091,31.269336),new BMap.Point(120.836571,31.270894),new BMap.Point(120.848627,31.266944),new BMap.Point(120.848088,31.274305),new BMap.Point(120.852651,31.277823),new BMap.Point(120.852148,31.286588),new BMap.Point(120.851501,31.289612),new BMap.Point(120.8607,31.29998),new BMap.Point(169.565455,59.888557),new BMap.Point(127.766796,63.843993),new BMap.Point(105.248505,67.593417),new BMap.Point(63.449847,71.40054),new BMap.Point(36.369026,71.02105),new BMap.Point(15.17534,65.298946),new BMap.Point(-31.03867,46.40664),new BMap.Point(-29.877341,23.562847),new BMap.Point(-13.099006,-11.80497),new BMap.Point(36.352928,-28.414229),new BMap.Point(97.284775,-24.170083),new BMap.Point(156.156125,-18.097719),new BMap.Point(176.172384,19.710626),new BMap.Point(176.172384,50.783234),new BMap.Point(174.406244,56.541381),new BMap.Point(169.341238,59.873529)],{strokeColor:"none",fillColor:"rgb(79,79,79)",strokeOpacity:1});
            map.addOverlay(ply1);
            var ply2 = new BMap.Polygon([new BMap.Point(120.877081,31.312409),new BMap.Point(120.867594,31.322775),new BMap.Point(169.341202,59.873565),new BMap.Point(169.418815,59.824861)],{strokeColor:"none",fillColor:"rgb(79,79,79)",strokeOpacity:1});
            map.addOverlay(ply2);
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