<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/7
 * Time: 15:11
 */

class HistoryQueryMonth{

    function QueryMonth($yearValue,$MonthStart,$MonthEnd,$changeValue){
        include "../../utils/conn.php";
        session_start();
        $enter_tsn = $_SESSION["enter_tsn"];
        $data = array();
        if($MonthStart<10){
            $MonthStart = "0".$MonthStart;
        }
        if($MonthEnd<10){
            $MonthEnd = "0".$MonthEnd;
        }
        //if($typeValue=="resource"){
        $sql = $conn->query("select sum((case `energy_big_type` when '水' then `".$changeValue."` else 0 end)) 'water',sum((case `energy_big_type` when '电' then `".$changeValue."` else 0 end)) 'electrical',sum((case `energy_big_type` when '煤' then `".$changeValue."` else 0 end)) 'coal',sum((case `energy_big_type` when '油' then `".$changeValue."` else 0 end)) 'oil',sum((case `energy_big_type` when '天然气' then `".$changeValue."` else 0 end)) 'gas',sum((case `energy_big_type` when '蒸汽' then `".$changeValue."` else 0 end)) 'steam',sum((case `energy_big_type` when '冷量' then `".$changeValue."` else 0 end)) 'cold' from `t_daily_data` where `enable`='启用' and `enter_tsn`='".$enter_tsn."' and DATE_FORMAT(import_time,'%Y-%c') between '".$yearValue."-".$MonthStart."' and '".$yearValue."-".$MonthEnd."'");
        $result = mysqli_fetch_array($sql);
        $query_type = array('水','电','煤','油','天然气','蒸汽','冷量');
        $sum_value = array($result["water"]*1,$result["electrical"]*1,$result["coal"]*1,$result["oil"]*1,$result["gas"]*1,$result["steam"]*1,$result["cold"]*1);
        $ConsumeSum = array_sum($sum_value);
        $sum_valuePie[] = array('水',$result["water"]*1);
        $sum_valuePie[] = array('电',$result["electrical"]*1);
        $sum_valuePie[] = array('煤',$result["coal"]*1);
        $sum_valuePie[] = array('油',$result["oil"]*1);
        $sum_valuePie[] = array('天然气',$result["gas"]*1);
        $sum_valuePie[] = array('蒸汽',$result["steam"]*1);
        $sum_valuePie[] = array('冷量',$result["cold"]*1);

        if($changeValue=="daily_indiff_value"){//等价值时，算水
            $sqlStr = "select year_energy_indiff_limit,year_source_indiff_limit from t_enterprise_info where tsn = '".$enter_tsn."'";
            $sqlSum = $conn->query($sqlStr);
            $resultSum = mysqli_fetch_array($sqlSum);
            $SourceTable = array($result["water"]*1,$result["electrical"]*1,$result["coal"]*1,$result["oil"]*1,$result["gas"]*1,$result["steam"]*1,$result["cold"]*1,$ConsumeSum-$result["water"]*1,$ConsumeSum,($resultSum["year_source_indiff_limit"]-$resultSum["year_energy_indiff_limit"])*1,$resultSum["year_energy_indiff_limit"]*1,$resultSum["year_energy_indiff_limit"]*1,$resultSum["year_source_indiff_limit"]*1);
            if($ConsumeSum!=0){
                $SourceTablePercentage = array(
                    number_format(($result["water"]*1)/$ConsumeSum*100, 2, '.', ''),
                    number_format(($result["electrical"]*1)/$ConsumeSum*100, 2, '.', ''),
                    number_format(($result["coal"]*1)/$ConsumeSum*100, 2, '.', ''),
                    number_format(($result["oil"]*1)/$ConsumeSum*100, 2, '.', ''),
                    number_format(($result["gas"]*1)/$ConsumeSum*100, 2, '.', ''),
                    number_format(($result["steam"]*1)/$ConsumeSum*100, 2, '.', ''),
                    number_format(($result["cold"]*1)/$ConsumeSum*100, 2, '.', ''),
                    number_format(($ConsumeSum-$result["water"]*1)/$ConsumeSum*100, 2, '.', ''),
                    100
                );
            }else{
                $SourceTablePercentage = array(0,0,0,0,0,0,0,0,100);
            }
        }else{//当量值时，不算水
            $sqlSum = $conn->query("select `year_energy_equival_limit` from t_enterprise_info where tsn = '".$enter_tsn."'");
            $resultSum = mysqli_fetch_array($sqlSum);
            $SourceTable = array($result["water"]*1,$result["electrical"]*1,$result["coal"]*1,$result["oil"]*1,$result["gas"]*1,$result["steam"]*1,$result["cold"]*1,$ConsumeSum-$result["water"]*1,$ConsumeSum,"0",$resultSum["year_energy_equival_limit"]*1,$resultSum["year_energy_equival_limit"]*1,$resultSum["year_energy_equival_limit"]*1);
            if($ConsumeSum!=0){
                $SourceTablePercentage = array(
                    0,
                    number_format(($result["electrical"]*1)/$ConsumeSum*100, 2, '.', ''),
                    number_format(($result["coal"]*1)/$ConsumeSum*100, 2, '.', ''),
                    number_format(($result["oil"]*1)/$ConsumeSum*100, 2, '.', ''),
                    number_format(($result["gas"]*1)/$ConsumeSum*100, 2, '.', ''),
                    number_format(($result["steam"]*1)/$ConsumeSum*100, 2, '.', ''),
                    number_format(($result["cold"]*1)/$ConsumeSum*100, 2, '.', ''),
                    number_format(($ConsumeSum-$result["water"]*1)/$ConsumeSum*100, 2, '.', ''),
                    100
                );
            }else{
                $SourceTablePercentage = array(0,0,0,0,0,0,0,0,100);
            }
        }
        array_push($data,$query_type,$sum_value,$sum_valuePie,$SourceTable,$SourceTablePercentage);
        echo json_encode($data);
        /*}else if($typeValue=="industry"){
            $sql = $conn->query("select b.`industry_type`,sum(a.`".$changeValue."`) as sum_value from `t_daily_data` a left join `t_enterprise_info` b on a.enter_tsn=b.tsn where a.`enable`='启用' and DATE_FORMAT(import_time,'%Y-%m') between '".$yearValue."-".$MonthStart."' and '".$yearValue."-".$MonthEnd."' group by b.`industry_type`");
            while($result = mysqli_fetch_array($sql)){
                $query_type[] = $result["industry_type"];
                $sum_value[] = $result["sum_value"]*1;
                $sum_valuePie[] = array($result["industry_type"] => $result["sum_value"]*1);
            }
            array_push($data,$query_type,$sum_value,$sum_valuePie);
            echo json_encode($data);
        }else{
            $sql = $conn->query("select b.`region`,sum(a.`".$changeValue."`) as sum_value from `t_daily_data` a left join `t_enterprise_info` b on a.enter_tsn=b.tsn where a.`enable`='启用' and DATE_FORMAT(import_time,'%Y-%m') between '".$yearValue."-".$MonthStart."' and '".$yearValue."-".$MonthEnd."'  group by b.`region`");
            while($result = mysqli_fetch_array($sql)){
                $query_type[] = $result["region"];
                $sum_value[] = $result["sum_value"]*1;
                $sum_valuePie[] = array($result["region"] => $result["sum_value"]*1);
            }
            array_push($data,$query_type,$sum_value,$sum_valuePie);
            echo json_encode($data);
        }*/
        mysqli_close($conn);
    }
}
$obj = new HistoryQueryMonth();
$obj->QueryMonth($_GET["yearValue"],$_GET["monthStart"],$_GET["monthEnd"],$_GET["changeValue"]);

//,$_GET["typeValue"]