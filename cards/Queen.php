<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 5/13/2018
 * Time: 6:37 PM
 */

require_once("IBicycleCard.php");

class Queen implements IBicycleCard
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