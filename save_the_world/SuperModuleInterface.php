<?php
/**
 * 各种超能力的接口
 */
interface SuperModuleInterface
{
    /**
     * 超能力激活方法
     *
     * 任何一个超能力都得有该方法，并拥有一个参数
     *@param array $target 针对目标，可以是一个或多个，自己或他人
     */
    public function activate(array $target = array());
}

/**
 * X-超能量
 */
class XPower implements SuperModuleInterface
{
    public function activate(array $target = array())
    {
        echo 'I am power!';
    }
}

/**
 * 终极炸弹 （就这么俗）
 */
class UltraBomb implements SuperModuleInterface
{
    public function activate(array $target = array())
    {
        echo 'I am bomb!';
    }
}



class Superman
{
    protected $module;

    public function __construct(SuperModuleInterface $module)
    {
        $this->module = $module;
    }

    public function fight() {
        $this->module->activate();
    }
}