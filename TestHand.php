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

    public function __construct(array $aStartingCards = array())
    {
        $this->aCards = $aStartingCards;
    }

    public function addCard(IBicycleCard $objCard)
    {
        $this->aCards[] = $objCard;
    }

    public function getTotal()
    {
        $intTotal = 0;

        foreach($this->aCards as $objCard){
            $intTotal += $objCard->getValue();
        }

        return $intTotal;
    }
}