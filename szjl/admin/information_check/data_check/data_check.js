/**
 * Created by zhangliqin on 2015/11/24.
 */
$(document).ready(function () {
    $.getJSON("query_condition.php", {
        'area': "全市",
        'industry': "全行业"
    }, function (json) {
        $("#name").append("<option>所有企业</option>");
        for (var i = 0; i < json.length; i++) {
            $("#name").append("<option>" + json[i] + "</option>");
        }
    });
    //区域变化对企业的影响
    $("#area").change(function () {
        $.getJSON("query_condition.php", {
            'area': $("#area").val(),
            'industry': $("#industry").val()
        }, function (json) {
            $("#name").empty();
            $("#name").append("<option>所有企业</option>");
            for (var i = 0; i < json.length; i++) {
                $("#name").append("<option>" + json[i] + "</option>");
            }
        });
    });
    //行业变化对企业的影响
    $("#industry").change(function () {
        $.getJSON("query_condition.php", {
            'area': $("#area").val(),
            'industry': $("#industry").val()
        }, function (json) {
            $("#name").empty();
            $("#name").append("<option>所有企业</option>");
            for (var i = 0; i < json.length; i++) {
                $("#name").append("<option>" + json[i] + "</option>");
            }
        });
    });
    $("#query").click(function () {
        $.getJSON("data_check_table.php", {
            'area': $("#area").val(),
            'industry': $("#industry").val(),
            'name': $("#name").val(),
            'date': $("#date").val(),
            'state': $("#state").val()
        }, function (json) {
            if (json == "") {
                $("#data_table").empty();
                sweetAlert("当前不存在" + $("#state").val() + "的数据！");
            } else {
                showtable(json);
                $("div.page").jPages({
                    containerID:"data_table",
                    previous:"上一页",
                    next:"下一页",
                    first:"第一页",
                    last:"最后一页",
                    perPage:10,
                    delay:10
                });
            }
        });
    });
    $("#pass").click(function () {
        pass();
    });
    $("#nopass").click(function () {
        nopass();
    });
});

function showtable(json) {
    $("#data_table").empty();
    var divnum = 1;
    for (var i = 0; i < json.length; i++) {
        var data = json[i];
        var td0 = "<tr><td><input name='box' type='checkbox' value='" + divnum + "'></td><td>" + divnum + "</td>";
        var td = "<td id='unit_name" + divnum + "'>" + data.enter_name + "</td><td id='fill_date" + divnum + "'>" + data.upd_date + "</td><td id='modify_date" + divnum + "'>" + data.import_time + "</td>";
        var td1 = "<td>" + data.water + "</td><td>" + data.electrical + "</td><td>" + data.coal + "</td><td>" + data.oil + "</td><td>" + data.gas + "</td><td>" + data.steam + "</td><td>" + data.cold + "</td>";
        var td2 = "<td>" + data.hand_water + "</td><td>" + data.hand_electrical + "</td><td>" + data.hand_coal + "</td><td>" + data.hand_oil + "</td><td>" + data.hand_gas + "</td><td>" + data.hand_steam + "</td><td>" + data.hand_cold + "</td>";
        var td3 = "<td id='data_state" + divnum + "'>" + data.state + "</td><td><a id='details" + divnum + "' href='javascript:;' class='zoomIn dialog'>详情</a></td><td><a onclick='downloadfile(" + divnum + ")'>下载附件</a></td></tr>";
        var newtable = td0 + td + td1 + td2 + td3;
        $("#data_table").append(newtable);
        details(divnum);
        divnum++;
    }
    $(function () {
        var $el = $('.dialog');
        $el.hDialog();
        $el.hDialog({
            title: '记录详情',
            box: '#HBox',
            boxBg: '#eeeeee',
            width: 1000,
            height: 600
        });
    });
}

function pass() {
    var obj = document.getElementsByName("box");
    var id_array = new Array();
    for (var i = 0; i < obj.length; i++) {
        if (obj[i].checked) {
            id_array.push(obj[i].value);
        }
    }
    for (var a = 0; a < id_array.length; a++) {
        var unit_name = document.getElementById("unit_name" + id_array[a] + "").innerText;
        var modify_date = document.getElementById("modify_date" + id_array[a] + "").innerText;   //修改日期
        var fill_date = document.getElementById("fill_date" + id_array[a] + "").innerText;       //填报日期
        var state1 = document.getElementById("data_state" + id_array[a] + "").innerText;          //状态
        if(state1 == "未通过审核" || state1 == "通过审核"){
            sweetAlert("不能重复审核数据！");
        }else{
            $.post("data_check_pass.php", {
                'unit_name': unit_name,
                'modify_date': modify_date,
                'fill_date': fill_date
            }, function (json) {
                if (json.substr(0,4) == "8006") {
                    sweetAlert("数据审核成功！");
                } else {
                    sweetAlert("数据审核失败！");
                }
            });
        }
    }
}

function nopass() {
    var obj = document.getElementsByName("box");
    var id_array = new Array();
    for (var i = 0; i < obj.length; i++) {
        if (obj[i].checked) {
            id_array.push(obj[i].value);
        }
    }
    for (var a = 0; a < id_array.length; a++) {
        var unit_name = document.getElementById("unit_name" + id_array[a] + "").innerText;
        var modify_date = document.getElementById("modify_date" + id_array[a] + "").innerText;
        var fill_date = document.getElementById("fill_date" + id_array[a] + "").innerText;
        var state = document.getElementById("data_state" + id_array[a] + "").innerText;
        if (state == "未通过审核" || state == "通过审核") {
            sweetAlert("不能重复审核数据！");
        } else {
            $.post("data_check_nopass.php", {
                'unit_name': unit_name,
                'modify_date': modify_date,
                'fill_date': fill_date
            }, function (json) {
                if (json == "数据更新成功！") {
                    sweetAlert("数据审核成功！");
                } else {
                    sweetAlert("数据审核失败！");
                }
            });
        }
    }
}

function details(divnum) {
    $("#details" + divnum).click(function () {
        $.getJSON("data_detail.php", {
            'unit_name': document.getElementById("unit_name" + divnum).innerText,
            'modify_date': document.getElementById("modify_date" + divnum).innerText,
            'fill_date': document.getElementById("fill_date" + divnum).innerText
        }, function (json) {
            $("#coal1").val(json.raw_coal_con);
            $("#coal2").val(json.washing_coal_con);
            $("#coal3").val(json.midding_con);
            $("#coal4").val(json.slurry_con);
            $("#coal5").val(json.coke_con);
            $("#oil1").val(json.crude_oil_con);
            $("#oil2").val(json.fuel_oil_con);
            $("#oil3").val(json.gasoline_con);
            $("#oil4").val(json.kerosene_con);
            $("#oil5").val(json.diesel_oil_con);
            $("#oil6").val(json.coal_tar_con);
            $("#oil7").val(json.residuum_con);
            $("#cold_quantity").val(json.cold_quantity_con);
            $("#steam").val(json.steam_con);
            $("#water1").val(json.new_water_con);
            $("#water2").val(json.soft_water_con);
            $("#water3").val(json.deo_water_con);
            $("#gas1").val(json.liq_pet_gas_con);
            $("#gas2").val(json.refinery_gas_con);
            $("#gas3").val(json.oil_field_gas_con);
            $("#gas4").val(json.gas_field_gas_con);
            $("#gas5").val(json.coal_mine_gas_con);
            $("#gas6").val(json.coke_gas_con);
            $("#gas7").val(json.blast_furn_gas_con);
            $("#gas8").val(json.generator_gas_con);
            $("#gas9").val(json.heavy_oil_con);
            $("#gas10").val(json.thermal_cracking_gas_con);
            $("#gas11").val(json.coke_gasification_con);
            $("#gas12").val(json.pressurized_gas_con);
            $("#gas13").val(json.water_gas_con);
            $("#electricity").val(json.electric_con);
        });
    });
}

function downloadfile(divnum) {
    $.getJSON("data_detail.php", {
        'unit_name': document.getElementById("unit_name" + divnum).innerText,
        'modify_date': document.getElementById("modify_date" + divnum).innerText,
        'fill_date': document.getElementById("fill_date" + divnum).innerText
    }, function (json) {
        if (json.certificate_path == "") {
            sweetAlert("当前节能措施不存在相关附件！");
        } else {
            window.open("" + json.certificate_path + "");
        }
    })
}

