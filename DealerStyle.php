<?php
/**
 * Created by PhpStorm.
 * User: metzenj
 * Date: 5/14/2018
 * Time: 12:59 PM
 */

require_once("IBlackjackPlayStyle.php");

class DealerStyle implements IBlackjackPlayStyle
{
    private $objHand;

    // @todo Rename.
    public function __construct(IBlackjackHand $objEmptyHand = null)
    {
        $this->objHand = $objEmptyHand;
    }

    public function decide()
    {
        $intTotal = $this->objHand->getTotal();

        if($intTotal > 17){
            return "stay";
        }
        else{
            return "hit";
        }
    }

    public function setHand(IBlackjackHand &$objHand)
    {
        $this->objHand = $objHand;
    }
}