<?php
namespace observer;
// 通知者类
class Subject {
    // 观察者存储容器
    private $observer = array();
    // 通知人
    public $name;

    /**
     * 添加观察者
     * @author lxf 2017-08-24
     * @param  Iobserver $observer [description]
     */
    public function add_observer(Iobserver $observer) {
        $this->observer[] = $observer;
    }

    /**
     * 删除观察者
     * @author lxf 2017-08-24
     * @param  Iobserver $observer [description]
     * @return [type]              [description]
     */
    public function del_observer(Iobserver $observer) {
        $this->observer = array_filter($this->observer, function($value) use($observer) {
            if ($value == $observer) {
                return FALSE;
            } else {
                return TRUE;
            }
        });
    }

    /**
     * 通知
     * @author lxf 2017-08-24
     * @return [type] [description]
     */
    public function notify() {
        foreach ($this->observer as $value) {
            $value->update();
        }
    }
}






