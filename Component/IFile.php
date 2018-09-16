<?php

namespace Component;

Interface IFile {
    public function add(IFile $f);

    public function remove(IFile $f);

    public function display();

    public function getChild();
}