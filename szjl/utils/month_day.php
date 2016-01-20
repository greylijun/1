<?php

function getMonthDay($month,$year){
    switch($month){
        case 4:
        case 6:
        case 9:
        case 11:
            $days = 30;
            break;
        case 2:
            if($year % 4 == 0){
                if($year % 100 == 0){                       //被100整除（28天）
                    $days = $year % 400 == 0 ? 29 : 28;     //被400整除（29天）否则（28天）
                }else{
                    $days = 29;                             //被4整除但不能被100整除（29天）
                }
            }else{
                $days = 28;                                 //不被4整除（28天）
            }
        break;
        default:
            $days = 31;
            break;
    }
    return $days;
}
?>