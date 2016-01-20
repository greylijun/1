/**
 * Created by LiJun on 2015/11/5.
 */
$(document).ready(function(){
    $.getJSON('user_statics/user_distribution.php',{
        user_area:"全市"
    },function(json){
        showUserreport(json);
        //console.log(json);
        $("div.page").jPages({
            containerID:"user_statics",
            previous:"上一页",
            next:"下一页",
            first:"第一页",
            last:"最后一页",
            perPage:5,
            delay:10
        });
    });
    $('#user_area').change(function(){
        $.getJSON('user_statics/user_distribution.php',{
            user_area:$('#user_area').val()
        },function(json){
            showUserreport(json);
            //console.log(json);
            $("div.table_pagination").jPages({
                containerID:"user_statics",
                previous:"上一页",
                next:"下一页",
                first:"第一页",
                last:"最后一页",
                perPage:5,
                delay:10
            });
        });
    });
    $.getJSON('user_statics/user_pie_chart.php',function(json){
        sum = json['total'];      //总数
        GSQ = json['GSQ_num'];    //姑苏区
        YQ = json['YQ_num'];      //园区
        GXQ = json['GXQ_num'];    //高新区
        WZQ = json['WZQ_num'];      //吴中区
        XCQ = json['XCQ_num'];      //相城区
        WJQ = json['WJQ_num'];      //吴江区
        KSS = json['KSS_num'];      //昆山市
        CSS = json['CSS_num'];      //常熟市
        ZJGS = json['ZJGS_num'];    //张家港市
        TCS  = json['TCS_num'];     //太仓市
        showpie(json);
        //console.log(json['total']);
    })
});


function showUserreport(json){
    $('#user_statics').empty();
    for(var i = 0;i<json.length;i++){
        var data = json[i];
        var newdiv =  createUserreport(data.id,data.name,data.region,data.sum_equival,data.sum_indiff,data.longitude,data.latitude);
        $('#user_statics').append(newdiv);
    }
}


function createUserreport(id,name,region,sum_equival,sum_indiff,longitude,latitude,readonly){
    var tr = $('<tr>');
    tr.append(createTD('name'+id,'',name,readonly));
    tr.append(createTD('region'+id,'',region,readonly));
    tr.append(createTD('sum_equival'+id,'',sum_equival,readonly));
    tr.append(createTD('sun_indiff'+id,'',sum_indiff,readonly));
    tr.append(createTD('longitude'+id+'latitude','','E'+longitude+','+'W'+latitude,readonly));
    return tr;
}
function showpie(json){
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            type: 'pie',
            name: '用能单位数量所占比例',
            data: [
                ['姑苏区',   GSQ/sum],
                ['园区',     YQ/sum],
                ['高新区',  GXQ/sum],
                //{
                //    name: 'Chrome',
                //    y: 12.8,
                //    sliced: true,
                //    selected: true
                //},
                ['吴中区',   WZQ/sum],
                ['相城区',   XCQ/sum],
                ['吴江区',   WJQ/sum],
                ['昆山市',   KSS/sum],
                ['常熟市',   CSS/sum],
                ['张家港市',  ZJGS/sum],
                ['太仓市',   TCS/sum]
            ]
        }]
    });
}