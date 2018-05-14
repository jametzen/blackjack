#!/usr/bin/php
<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 5/12/2018
 * Time: 2:04 PM
 */

define("PLAYERS_PER_GAME", 5);

require_once("TestHand.php");
require_once("AggressiveStyle.php");

require_once("cards/Two.php");
require_once("cards/Three.php");
require_once("cards/Four.php");
require_once("cards/Five.php");
require_once("cards/Six.php");
require_once("cards/Seven.php");
require_once("cards/Eight.php");
require_once("cards/Nine.php");
require_once("cards/Ten.php");
require_once("cards/Jack.php");
require_once("cards/Queen.php");
require_once("cards/King.php");
require_once("cards/Ace.php");

/*
 * Game
 * Hand
 * Card
 * Player
 *  Dealer
 * PlayStyle
 * ScoreKeeper? (Some kind of DB interface)
 */

// The goal is to play n hands of Blackjack with various play styles, tracking which style statistically does better.

// Not doing much validation. We just need the number of hands to process from the command line.
// Could take some config options for play styles to use, etc. in the future.
if(count($argv) == 2){
    // @note Important to distinguish between a game, and a hand. A hand refers to the cards a player has during a game.
    $intNumGames = $argv[1];

    // @note This means that we're reusing styles throughout the process, and will need to clear hands and other data
    // between games.
    // @todo Fix the lack of an empty hand issue.
    $aPlayersToStyles = array(
            1 => new AggressiveStyle(),
            2 => new AggressiveStyle(),
            3 => new AggressiveStyle(),
            4 => new AggressiveStyle(),
            5 => new AggressiveStyle());

    $aPlayerHands = array();

    // $aDeck = array_flip(range(1, 52));
    $aDeck = array();
    $aSuites = array("Clubs", "Diamonds", "Hearts", "Spades");
    $aCardSequence = array("Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Jack", "Queen", "King", "Ace");

    // Fill and shuffle our deck.
    foreach($aCardSequence as $strCard){
        foreach($aSuites as $strSuite){
            $aDeck[] = new $strCard($strSuite);
        }
    }

    echo "Deck:\n" . print_r($aDeck, true) . "\n";

    echo "Number of hands to process: $intNumGames\n";

    for($intGameNumber=1; $intGameNumber<=$intNumGames; $intGameNumber++){
        // $objGame = new Blackjack();
        // $objGame->setPlayerCount(PLAYERS_PER_GAME);

        // echo "Creating a test play style for game number $intGameNumber\n";
        $objTestHand = new TestHand();
        $objTestStyle = new AggressiveStyle($objTestHand);

        // Deal two cards, face up, to each player. One face up and one face down to the dealer.
        for($intPlayerNum=1; $intPlayerNum<=PLAYERS_PER_GAME; $intPlayerNum++){
            $aPlayerHands[$intPlayerNum] = new TestHand(array(new Ace("Spades")));

            // For each player in the game, play until a stay, 21, or bust.
        }
    }
}