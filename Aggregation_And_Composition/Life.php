<?php
//定义Life 类文件
class Life
{
    //声明属性
    private $lifeWork;
    private $owner;
    private $liftZuhe;

    //构造函数
    public function  __construct($owner) {
        $this->owner = $owner;
    }

    //采用对象聚合的方式，将对象作为一个参数赋值给成员属性
    public function addWorkToLife(Work $work) {
        $this->lifeWork[]= $work;
    }

    //显示所有的工作信息
    public function displayWorks() {
        $workInfo="Juhe | " . $this->owner;
        //调用循环输出信息
        foreach($this->lifeWork as $work) {
            $workInfo.= '  ' . $work->getInfo() ;
        }
        //返回结果值
        return $workInfo;
    }

    //采用对象组合的方式，将对象直接实例化在方法内部
    public function showWorkLife() {
        $this->lifeZuhe = new work('xiaozhe',666);
        $returnValue = 'Zuhe | '.$this->owner.' | '.$this->lifeZuhe->getInfo() . '<br/>';
        return $returnValue;
    }

}