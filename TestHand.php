<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 5/13/2018
 * Time: 1:03 AM
 */

require_once("IBlackjackHand.php");

class TestHand implements IBlackjackHand
{
    private $aCards;

    public function __construct()
    {
        $this->aCards = array();
    }

    public function addCard(IBicycleCard $objCard)
    {
        $this->aCards[] = $objCard;
    }
}