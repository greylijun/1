<?php

class LoadDataQuery{
	
	function LoadData(){
		session_start();
		$enter_tsn = $_SESSION["enter_tsn"];
		//$EnergyType = array();
		//$EquValue = array();
		//$sum_valuePie = array();
		$Data = array();
		include "../../utils/conn.php";
		$Year = date('Y');
		$sql = $conn->query("select sum((case `energy_big_type` when '水' then `daily_equival_value` else 0 end)) 'water',sum((case `energy_big_type` when '电' then `daily_equival_value` else 0 end)) 'electrical',sum((case `energy_big_type` when '煤' then `daily_equival_value` else 0 end)) 'coal',sum((case `energy_big_type` when '油' then `daily_equival_value` else 0 end)) 'oil',sum((case `energy_big_type` when '天然气' then `daily_equival_value` else 0 end)) 'gas',sum((case `energy_big_type` when '蒸汽' then `daily_equival_value` else 0 end)) 'steam',sum((case `energy_big_type` when '冷量' then `daily_equival_value` else 0 end)) 'cold' from `t_daily_data` where `enable`='启用' and DATE_FORMAT(import_time,'%Y') = '".$Year."' and `enter_tsn`='".$enter_tsn."'");
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
		array_push($Data,$query_type,$sum_value,$sum_valuePie,$SourceTable,$SourceTablePercentage);
		echo json_encode($Data);
		mysqli_close($conn);
	}
}

$obj = new LoadDataQuery();
$obj->LoadData();