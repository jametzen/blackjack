<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 5/12/2018
 * Time: 11:16 PM
 */

require_once("IPlayStyle.php");

interface IBlackjackPlayStyle extends IPlayStyle
{
    // @note Need to take some kind of card object or similar: Might want to make decisions based on weird criteria, such as suite, etc.
    // Also probably need to be able to look at an overall hand: We might want to make crazy decisions based on a combination
    // of cards we're already received.
    // @todo Inject dependencies in the constructor?
    // public function decide(IBlackjackHand $objHand);
    public function decide(IBicycleCard $objCard);

    public function setHand(IBlackjackHand $objHand);
}