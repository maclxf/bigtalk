<?php
class Work
{
    //声明两个属性
    //工作状态
    private $state;
    //薪水
    private $salary;
    //构造方法
    public function  __construct($state,$salary){
        $this->state = $state;
        $this->salary = $salary;
    }
    //获取属性信息的函数
    public function getInfo()
    {
        return $this->state . $this->salary;
    }
}