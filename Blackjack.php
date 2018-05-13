<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 5/12/2018
 * Time: 2:09 PM
 */

class Blackjack implements IGame
{
    private $intNumPlayers;
    private $objDealer;

    public function start()
    {

    }

    public function stop()
    {

    }

    public function addPlayer()
    {

    }

    public function setPlayerCount($intCount)
    {
        $this->intNumPlayers = $intCount;
    }

    // @todo Make Dealer an interface that extends the player interface?
    //?
    public function setDealer(IPlayer $objDealer)
    {
        $this->$objDealer = $objDealer;
    }
}