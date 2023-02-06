
<?php
//定义抽奖项
$prize_arr=array(
	'0' => array('id'=>1,'min'=>137,'max'=>178,'prize'=>'一等奖','v'=>9984),
    '1' => array('id'=>2,'min'=>227,'max'=>268,'prize'=>'二等奖','v'=>5),
    '2' => array('id'=>3,'min'=>1,'max'=>44,'prize'=>'三等奖','v'=>10),
    '3' => array('id'=>4,'min'=>array(47,92,182,272,317),'max'=>array(88,133,223,313,358),'prize'=>'再接再励,下次可能中奖哦！','v'=>1),
);

foreach($prize_arr as $k=>$v){
	$varr[$v['id']] = $v['v'];
}

//根据概率获取中奖id
$rid = get_rand($varr);
//中奖项
$rs = $prize_arr[$rid-1];
$min = $rs['min'];
$max = $rs['max'];

//判断￥rs的id是否是3，（判断min和max是否是数组）
if($rs['id']=='4'){
	$i = mt_rand(0,4);
	$result['angle'] = mt_rand($min[$i],$max[$i]);
}else{
	$result['angle'] = mt_rand($min,$max);
}
$result['prize'] = $rs['prize'];
$result['rid']=$rs['id'];
echo json_encode($result);
//概率算法
function get_rand($proArr) {
	$result = '';
	//概率数组的总概率精度
	$proSum = array_sum($proArr);
	//概率数组循环
	foreach ($proArr as $key => $proCur) {
		$randNum = mt_rand(1, $proSum);
		if ($randNum <= $proCur) {
			$result = $key;
			break;
		} else {
			$proSum -= $proCur;
		}
	}
	unset ($proArr);
	return $result;
}
