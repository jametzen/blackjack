<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 5/13/2018
 * Time: 6:39 PM
 */

require_once("IBicycleCard.php");

class King implements IBicycleCard
{
    private $strSuite;

    public function __construct($strSuite)
    {
        $this->strSuite = $strSuite;
    }

    public function getValue()
    {
        return 10;
    }
}