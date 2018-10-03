<?php
namespace TIterator;

interface PIterator {
    public function hasNext();
    public function next();
    public function getItem();
}