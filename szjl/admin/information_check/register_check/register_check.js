/**
 * Created by LiJun on 2015/12/1.
 */
$(document).ready(function(){
    $.getJSON("query_condition.php",{
        'area':"全市",
        'industry':"全行业",
        'second_industry_type':"全行业"
    },function(json){
        $("#second_industry_type").append("<option>全行业</option>");
        $("#name").append("<option>所有企业</option>");
        for(var i=0;i<json.length;i++){
            $("#name").append("<option>"+json[i]+"</option>");
        }
    });
    //区域变化对企业的影响
    $("#area").change(function(){
        $.getJSON("query_condition.php",{
            'area':$("#area").val(),
            'industry':$("#industry").val(),
            'second_industry_type':$("#second_industry_type").val()
        },function(json){
            $("#name").empty();
            $("#name").append("<option>所有企业</option>");
            for(var i=0;i<json.length;i++){
                $("#name").append("<option>"+json[i]+"</option>");
            }
        });
    });
    //一级行业变化对企业的影响
    $("#industry").change(function(){
        $.getJSON("../../../utils/industry_select.php",{
            'industry_type':$("#industry").val()
        },function(json){
            $("#second_industry_type").empty();
            if(json == ""){
                $("#second_industry_type").append("<option>全行业</option>");
            }else{
                $("#second_industry_type").append("<option>全行业</option>");
                for(var i =0 ;i<json.length;i++){
                    var data = json[i];
                    $("#second_industry_type").append("<option>"+data.second_industry+"</option>");
                }
            }
        });
        $.getJSON("query_condition.php",{
            'area':$("#area").val(),
            'industry':$("#industry").val(),
            'second_industry_type':$("#second_industry_type").val()
        },function(json){
            $("#name").empty();
            $("#name").append("<option>所有企业</option>");
            for(var i=0;i<json.length;i++){
                $("#name").append("<option>"+json[i]+"</option>");
            }
        });
    });
    //二级行业变化对企业的影响
    $("#second_industry_type").change(function(){
        $.getJSON("query_condition.php",{
            'area':$("#area").val(),
            'industry':$("#industry").val(),
            'second_industry_type':$("#second_industry_type").val()
        },function(json){
            $("#name").empty();
            $("#name").append("<option>所有企业</option>");
            for(var i=0;i<json.length;i++){
                $("#name").append("<option>"+json[i]+"</option>");
            }
        });
    });
    $("#query").click(function(){
        $.getJSON("register_query.php",{
            'area':$("#area").val(),
            'industry':$("#industry").val(),
            'second_industry_type':$("#second_industry_type").val(),
            'name':$("#name").val(),
            'state':$("#state").val()
        },function(json){
            if(json == ""){
                console.log(111);
                $("#register_table").empty();
                sweetAlert("当前不存在"+$("#state").val()+"的企业！");
            }else{
                showtable(json);
                $("div.page").jPages({
                    containerID:"register_table",
                    previous:"上一页",
                    next:"下一页",
                    first:"第一页",
                    last:"最后一页",
                    perPage:8,
                    delay:10
                });
            }
        });
    });
    $("#pass").click(function(){
        pass();
        $("#register_table").empty();
    });
    $("#nopass").click(function(){
        nopass();
        $("#register_table").empty();
    });
});

function showtable(json){
    $("#register_table").empty();
    var divnum = 1;
    for(var i = 0;i<json.length;i++){
        var data = json[i];
        var td = "<tr><td><input name='box' type='checkbox' value='"+divnum+"'></td><td>"+divnum+"</td>";
        var td1 = "<td id='region"+divnum+"'>"+data.region+"</td><td id='industry"+divnum+"'>"+data.industry_type+"</td><td id='name"+divnum+"'>"+data.name+"</td><td id='contacts"+divnum+"'>"+data.business_contacts+"</td><td id='contact_number"+divnum+"'>"+data.contact_number+"</td><td id='business_phone"+divnum+"'>"+data.business_phone+"</td><td><input id='longitude"+divnum+"' value='"+data.longitude+"'></td><td><input id='latitude"+divnum+"' value='"+data.latitude+"'></td><td><a target='_blank' href='"+data.lic_image_path+"'>查看图片</a></td><td id='review"+divnum+"'>"+data.review+"</td>";
        var td2 ="<td><a id='detail"+divnum+"' href='javascript:;' class='zoomIn dialog'>详情</a></td></tr>";
        var div = td+td1+td2;
        $("#register_table").append(div);
        detail(divnum);
        //delete1(divnum);
        divnum++;
    }
    $(function(){
        var $el = $('.dialog');
        $el.hDialog();
        $el.hDialog({
            title:'记录详情',
            box: '#HBox',
            boxBg: '#eeeeee',
            width: 1000,
            height: 400
        });
    });
}

function pass(){
    var obj = document.getElementsByName("box");
    var id_array = new Array();
    for(var i =0;i<obj.length;i++){
        if(obj[i].checked){
            id_array.push(obj[i].value);
        }
    }
    for(var a=0;a<id_array.length;a++){
        var name = document.getElementById("name"+id_array[a]+"").innerText;
        var state = document.getElementById("review"+id_array[a]+"").innerText;
        var longitude = $("#longitude"+id_array[a]+"").val(); //经度
        var latitude = $("#latitude"+id_array[a]+"").val();   //纬度
        if(state == '未通过审核'){
            sweetAlert("不能对该企业信息重复审核！请等待该企业重新提交注册信息后再次审核！");
        }else{
            if(longitude != "" && latitude != ""){
                $.post("register_state.php",{
                    'name':name,
                    'longitude':longitude,
                    'latitude':latitude,
                    'state':"通过审核"
                },function(json){
                    if(json == "8006"){
                        sweetAlert("注册信息审核完成！");
                    }else{
                        sweetAlert("注册信息审核失败！");
                    }
                });
                $.post("register_mail.php",{
                    'name':name,
                    'state':"通过审核"
                },function(json){
                });
            }else{
                sweetAlert("请填写该企业经纬度！");
            }
        }
    }
}

function nopass(){
    var obj = document.getElementsByName("box");
    var id_array = new Array();
    for(var i =0;i<obj.length;i++){
        if(obj[i].checked){
            id_array.push(obj[i].value);
        }
    }
    for(var a=0;a<id_array.length;a++){
        var name = document.getElementById("name"+id_array[a]+"").innerText;
        var state = document.getElementById("review"+id_array[a]+"").innerText;
        var longitude = $("#longitude"+id_array[a]+"").val(); //经度
        var latitude = $("#latitude"+id_array[a]+"").val();   //纬度
        if(state == '通过审核'){
            sweetAlert("不能对通过审核数据执行此操作！");
        }else{
            if(longitude != "" && latitude != ""){
                $.post("register_mail.php",{
                    'name':name,
                    'state':"未通过审核"
                },function(json){
                });
                $.post("register_state.php",{
                    'name':name,
                    'longitude':longitude,
                    'latitude':latitude,
                    'state':"未通过审核"
                },function(json){
                    if(json == "8006"){
                        sweetAlert("注册信息审核完成！");
                    }else{
                        sweetAlert("注册信息审核失败！");
                    }
                });
            }else{
                sweetAlert("请填写该企业经纬度！");
            }
        }
    }
}

function detail(divnum){
    $("#detail"+divnum).click(function(){
        $.getJSON("register_detail.php",{
            'name':document.getElementById("name"+divnum).innerText,
            'state':document.getElementById("review"+divnum).innerText
        },function(json){
            $("#unit_name").val(json.enter_name);
            $("#lic_number").val(json.license_registration_number);
            $("#org_code").val(json.organization_code);
            $("#legal_person").val(json.legal_person);
            $("#business_contact").val(json.business_contacts);
            $("#contact_num").val(json.contact_number);
            $("#region").val(json.region);
            $("#industry_type").val(json.industry_type);
            $("#second_industry_type_detail").val(json.second_industry_type);
            $("#unit_industry_type").val(json.unit_industry_type);
            $("#business_phone").val(json.business_phone);
            $("#zip_code").val(json.zip_code);
            $("#E-mail").val(json.E_mail);
            $("#fax").val(json.fax);
            $("#reg").val(json.registered_address);
            $("#pro").val(json.production_address);
        })
    });
}

function delete1(){
    var obj = document.getElementsByName("box");
    var id_array = new Array();
    for(var i =0;i<obj.length;i++){
        if(obj[i].checked){
            id_array.push(obj[i].value);
        }
    }
    for(var a=0;a<id_array.length;a++) {
        var name = document.getElementById("name"+id_array[a]+"").innerText;
        var state = document.getElementById("review"+id_array[a]+"").innerText;
        if(state == "未通过审核"){
            $.getJSON("delete_nopass_register.php",{
                'name':name,
                'state':state
            },function(json){
                if(json == "8006"){
                    sweetAlert("数据删除成功！");
                }else{
                    sweetAlert("数据删除失败！");
                }
            });
        }else if(state == "未审核"){
            sweetAlert("不能对未审核数据执行删除操作！");
        }else{
            sweetAlert("不能对通过审核数据执行删除操作！");
        }
    }
    $("#register_table").empty();
}



