<?php
namespace TIterator;
class ProductIterator implements PIterator {

    private $pobj;

    private $plist;
    /**
     * 当前指针
     * @var [type]
     */
    private $index;

    public function __construct(ProductList $pobj) {
        $this->pobj = $pobj;
        $this->plist = $pobj->getList();
        $this->index = 0;
    }

    public function hasNext() {
        if ($this->index >= count($this->plist)) {
            return false;
        }

        return true;
    }

    public function next() {
        if ($this->hasNext()) {
            $this->index++;
        }
    }

    public function getItem() {
        return $this->plist[$this->index] . '<br>';
    }
}
