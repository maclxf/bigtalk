<?php

namespace Component;

class Folder implements IFile {
    public $name;

    public $child;

    public function __construct($name) {
        $this->name = $name;
    }

    public function add(IFile $f) {
        return $this->child[] = $f;
    }

    public function remove(IFile $f) {
        if ($this->child) {
            foreach ($this->child as  $key => $value) {
                if ($value instanceof $f) {
                    unset($this->child[$key]);
                }
            }
        }
    }

    public function display() {
        echo $this->name;
    }

    public function getChild() {
        if ($this->child) {
            foreach ($this->child as  $key => $value) {
                $this->display();
                if ($value instanceof File) {
                    $value->display();
                    echo '<br>';
                } else {
                    $value->display();
                    $value->getChild();

                }
            }
        }
    }
}