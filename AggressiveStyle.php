<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 5/13/2018
 * Time: 12:59 AM
 */

require_once("IBlackjackPlayStyle.php");

class AggressiveStyle implements IBlackjackPlayStyle
{
    private $objHand;

    public function __construct(IBlackjackHand $objEmptyHand)
    {
        $this->objHand = $objEmptyHand;
    }

    public function decide(IBicycleCard $objCard)
    {

    }
}