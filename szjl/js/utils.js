/**
 * Created by LiJun on 2015/5/28.
 */
function createTD(id,td_class,text,readonly){
    var td = $("<td>");
    td.attr('class',td_class);
    td.append(createInput(id,'text',isVarUndefined(text),readonly));
    return td;
}
function isVarUndefined(variable) {
    return ((variable == undefined) ? '' : variable);
}
function createInput(id,type,text,readonly){
    var input = $('<input>');
    input.attr('id',id);
    input.attr('type',type);
    input.attr('value',text);
    input.attr('readonly',true);
    return input;
}

