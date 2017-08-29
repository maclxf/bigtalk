<?php
namespace Facade;

class Player {
    protected $name;

    public function __construct ($player_name) {
        $this->name = $player_name;
    }

}