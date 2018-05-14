<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 5/13/2018
 * Time: 12:51 AM
 */

require_once("IHand.php");

// @note Making this an interface for the moment, as it's best to "depend on abstractions."
interface IBlackjackHand extends IHand
{
    public function addCard(IBicycleCard $objCard);
    public function getTotal();
}