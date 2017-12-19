<?php
class Container
{
    protected $binds;

    protected $instances;

    /**
     * 注册超能力
     * @author lxf 2017-12-14
     * @param  [type] $abstract 注册超能力的名称
     * @param  [type] $concrete 如果是匿名函数那么绑定给binds,否则直接当作是实例给instances
     * @return [type]           [description]
        $concrete = function() {
            return new XXX();
        }
        $concrete = new XXX();
        $concrete 有这两种情况
     */
    public function bind($abstract, $concrete)
    {
        if ($concrete instanceof Closure) {
            $this->binds[$abstract] = $concrete;
        } else {
            $this->instances[$abstract] = $concrete;
        }
    }


    public function make($abstract, $parameters = [])
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        array_unshift($parameters, $this);

        return call_user_func_array($this->binds[$abstract], $parameters);
    }
}