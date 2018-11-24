<?php
require_once("aggregation_and_composition/Work.php");
require_once("aggregation_and_composition/Life.php");

//实例化一个Life对象
$life=new Life("Andy");
//组合
echo $life->showWorkLife();


//聚合
//实例化两个Work对象
$work1=new Work('past',15);
$work2=new Work("now",30);
//调用life对象的addWorkToLife方法，添加Work对象
$life->addWorkToLife($work1);
$life->addWorkToLife($work2);
echo $life->displayWorks();
?>