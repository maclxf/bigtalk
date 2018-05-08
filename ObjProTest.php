<?php
class House {
    public $price;
    public $address;
    private $house_owner;

    public function __construct($price,$address,$house_owner){

            $this->price = $price;
            $this->address = $address;
            //$this->house_owner = $house_owner;
    }

    public function __unset($pro_houser_onwer){
        if(property_exists($this, $pro_houser_onwer)){
            unset($this->$pro_houser_onwer);
        }else{
            echo '没有这个属性';
        }
    }

    public function __isset($pro_houser_onwer){
        if(property_exists($this, $pro_houser_onwer)){
            return true;
        }else{
            return false;
        }
    }
}
$house1 = new House(30000,'广州','波波酱');
/*if(isset($house1->house_owner)){
    echo '房主存在';
}else{
    echo '这是空房';
}*/

echo'<pre>';
var_dump($house1);

unset($house1->house_owner);

echo'<hr>';
var_dump($house1);

echo'<hr>';
if(isset($house1->house_owner)){
    echo '房主存在';
}else{
    echo '这是空房';
}
