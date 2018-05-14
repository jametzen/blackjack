<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 5/13/2018
 * Time: 10:18 PM
 */

require_once("IDeck.php");

class BlackjackDeck implements IDeck
{
    private $aCards;

    public function addCard(ICard $objCard)
    {
        $this->aCards[] = $objCard;
    }

    public function shuffle()
    {
        shuffle($this->aCards);
    }

    public function dealOne()
    {
        // @note Just using array_pop as it's faster.
        return array_pop($this->aCards);
    }

    // @todo Handle the event in which we run out of cards with an Exception or similar.
    public function deal($intNum)
    {
        $aReturn = array();

        for($i=0;$i<=$intNum;$i++){
            $objNew = $this->dealOne();

            if($objNew != null){
                $aReturn[] = $objNew;
            }
            else{
                break;
            }
        }

        return $aReturn;
    }
}