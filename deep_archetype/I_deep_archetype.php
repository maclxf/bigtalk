<?php

abstract class I_deep_archetype {
    private $workdate;
    private $company;
.
    public function setworkdate($workdate) {
        $this->workdate = $workdate;
        return $this->workdate;
    }

    public function setcompany($company) {
        $this->company = $company;
        return $this->company;
    }

    public function clone() {
        return $this->MemberwiseClone();
    }
}