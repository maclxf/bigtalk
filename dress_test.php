<?php
	include_once('dress/Concretecomponent.php');
    include_once('dress/DressA.php');
    include_once('dress/DressB.php');


    $person = new Concretecomponent();
    $dressa = new DressA();
    $dressb = new DressB();

   $dressa->setcomponent($person);
   $dressb->setcomponent($dressa);
   $dressb->operation();


