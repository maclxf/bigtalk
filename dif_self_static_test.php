<?php

require_once ('dif_self_static/Car.php');
//require_once ('dif_self_static/TaxiStatic.php');
require_once ('dif_self_static/TaxiSelf.php');

//echo '这是调用static的例子：<br>';
/*
这里不用new这是static方法的特性，不用实例话就可以访问静态方法
Car这里就是访问类的model，model方法中代码：static::getmodel();，表示访问Car的静态方法getmodel所以输出This is car
*/
//echo Car::model(); //This is car.
//echo '<br>';
/*
TaxiStatic这里访问的是
 */
//echo TaxiStatic::model();//This is taxi.



/*---------------------------------------------------------------------------------*/

echo '这是调用self的例子：<br>';
echo Car::model();
echo '<br>';
echo TaxiSelf::model();
//这是调用self的例子：
//This is car.
//This is car.