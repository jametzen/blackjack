<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 5/19/2018
 * Time: 3:17 PM
 */

// @note I'm constraining the scope of this program to Blackjack-specific stuff only. That means that there may not
// be a generic "game" interface to implement from. I also don't see a need to create Blackjack game interface
// if there won't be any implementation-specific variants of the class.

class BlackjackGame
{
    private $aPlayers;
    private $objDealer;

    // @note Dealer tracks other players state?
    public function __construct(BlackjackDealer $objDealer)
    {
        $this->objDealer = $objDealer;
    }

    public function addPlayer(BlackjackPlayer $objPlayer)
    {
        $this->aPlayers[$objPlayer->getPlayerNumber()] = $objPlayer;
    }

    // @todo Figure out how the Dealer class fits into all of this. This might need to be moved into that class.
    public function dealHand(BlackjackDeck $objDeck)
    {
        foreach($this->aPlayers as $objPlayer){
            $objPlayer->addToHand($objDeck->draw(2));
        }
    }

    public function isFinished()
    {
        // This method should return false if the dealer isn't currently playing against someone.
        return ($this->objDealer->playing() == false);
    }

    // @todo This was meant to be a really high level function. We'll probably want to nest a lower-level function
    // inside of this one to track details.
    public function getPlayerInput(BlackjackDealer $objDealer, BlackjackPlayer $objPlayer)
    {
        $objDealer->setOpponent($objPlayer);
        $intTotal = $objPlayer->getTotal();

        if($intTotal > 21){
            return "bust"; // @todo Figure out how outputs from this function work a little better.
        }

        if($intTotal == 21){
            return "blackjack";
        }

        while($objPlayer->decide() != "stay"){
            $intTotal += $objPlayer->getTotal();

            if($intTotal > 21){
                return "bust"; // @todo Figure out how outputs from this function work a little better.
            }

            if($intTotal == 21){
                return "blackjack";
            }
        }

        return "stay";
    }

    // @note Should actually return an array: There could be more than one "winner," in the event of the same total
    // for multiple players.
    public function getWinner()
    {
        $intDealerTotal = $this->objDealer->getTotal();
        $intHighestPlayerTotal = 0;
        $aWinners = array();

        if($intDealerTotal == 21){
            return $this->objDealer;
        }

        foreach($this->aPlayers as $objPlayer){
            $intPlayerTotal = $objPlayer->getTotal();

            if($intPlayerTotal <= 21){
                if($intPlayerTotal == $intHighestPlayerTotal){
                    $aWinners[$objPlayer->getPlayerNumber()] = $objPlayer;
                }
                elseif($intPlayerTotal > $intHighestPlayerTotal){
                    $aWinners = array($objPlayer);
                }
            }
        }

        return $aWinners;
    }
}