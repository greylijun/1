/**
 * Created by LiJun on 2015/11/10.
 */
$(document).ready(function(){
    $.getJSON("enterprise_query.php",function(json){
        $("#name").attr("value",json.name);
        $("#lic_number").attr("value",json.lic_number);
        $("#org_code").attr("value",json.org_code);
        $("#legal_person").attr("value",json.legal_person);
        $("#business_contact").attr("value",json.business_contact);
        $("#contact_num").attr("value",json.contact_num);
        $("#region").attr("value",json.region);
        $("#industry_type").attr("value",json.industry_type);
        $("#second_industry_type").attr("value",json.second_industry_type);
        $("#business_phone").attr("value",json.business_phone);
        $("#zip_code").attr("value",json.zip_code);
        $("#E-mail").attr("value",json.Email);
        $("#fax").attr("value",json.fax);
        $("#reg").attr("value",json.reg_address);
        $("#pro").attr("value",json.pro_address);
        $("#image").attr("src","../../"+json.image_path);
        $("#point_num").attr("value",json.path_num);
        $("#last_energy").attr("value",json.last_sum);
        showtext(json);
    });
});

function showtext(json){
    var p = "<p>"+json.about_enter+"</p>";
    $("#about_enter").append(p);
}