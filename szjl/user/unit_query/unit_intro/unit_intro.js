/**
 * Created by LiJun on 2015/11/10.
 */
$(document).ready(function(){


    $.getJSON("enterprise_query.php",function(json){
        $("#name").attr("value",json.name);                                 //企业名称
        $("#lic_number").attr("value",json.lic_number);                     //营业执照注册号
        $("#org_code").attr("value",json.org_code);                         //组织机构代码
        $("#legal_person").attr("value",json.legal_person);                 //企业法人
        $("#business_contact").attr("value",json.business_contact);         //单位联系人
        $("#contact_num").attr("value",json.contact_num);                   //联系人号码
        document.getElementById("region").value = json.region;              //区域
        document.getElementById("industry_type").value = json.industry_type;//一级行业
        $("#second_industry_type").append("<option>"+json.second_industry_type+"</option>"); //二级行业
        $("#business_phone").attr("value",json.business_phone);             //单位电话
        $("#zip_code").attr("value",json.zip_code);                         //邮政编码
        $("#E-mail").attr("value",json.Email);                              //E-mail
        $("#fax").attr("value",json.fax);                                   //单位传真
        $("#reg").attr("value",json.reg_address);                           //单位注册地址
        $("#pro").attr("value",json.pro_address);                           //单位生产地址
        $("#image").attr("src","../../"+json.image_path);                   //图片路径
        $("#point_num").attr("value",json.path_num);                        //采集点数
        $("#last_energy").attr("value",json.last_sum);                      //上一日综合能耗
        showtext(json);
    });
    $("#industry_type").change(function(){
        $.getJSON("../../../utils/industry_select.php",{
            'industry_type':$("#industry_type").val()
        },function(json){
            $("#second_industry_type").empty();
            for(var i=0;i<json.length;i++){
                var data = json[i];
                $("#second_industry_type").append("<option>"+data.second_industry+"</option>");
            }
        });
    });
    $("#submit").click(function(){
        $.post("update_unit_intro.php",{
            'name':$("#name").val(),
            'lic_number':$("#lic_number").val(),
            'legal_person':$("#legal_person").val(),
            'business_contact':$("#business_contact").val(),
            'contact_num':$("#contact_num").val(),
            'region':$("#region").val(),
            'industry_type':$("#industry_type").val(),
            'unit_industry_type':$("#unit_industry_type").val(),
            'business_phone':$("#business_phone").val(),
            'zip_code':$("#zip_code").val(),
            'E-mail':$("#E-mail").val(),
            'fax':$("#fax").val(),
            'reg':$("#reg").val(),
            'pro':$("#pro").val()
        },function(json){
            if(json == '8006'){
                sweetAlert("信息更新成功！");
            }else{
                sweetAlert("信息更新失败！");
            }
        })
    });
});

function showtext(json){
    var p = "<p>"+json.about_enter+"</p>";
    $("#about_enter").append(p);
}