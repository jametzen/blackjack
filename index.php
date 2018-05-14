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
require_once("DealerStyle.php");
require_once("BlackjackDeck.php");

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

    $aResults = array();

    $aPlayerHands = array();

    // $aDeck = array_flip(range(1, 52));
    $aDeck = array();
    $objDeck = new BlackjackDeck();
    $aSuites = array("Clubs", "Diamonds", "Hearts", "Spades");
    $aCardSequence = array("Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Jack", "Queen", "King", "Ace");

    // Fill and shuffle our deck.
    foreach($aCardSequence as $strCard){
        foreach($aSuites as $strSuite){
            $aDeck[] = new $strCard($strSuite);
            $objDeck->addCard(new $strCard($strSuite));
        }
    }

    shuffle($aDeck);
    $objDeck->shuffle();

    // echo "Deck:\n" . print_r($aDeck, true) . "\n";

    echo "Number of hands to process: $intNumGames\n";

    for($intGameNumber=1; $intGameNumber<=1; $intGameNumber++){
        // $objGame = new Blackjack();
        // $objGame->setPlayerCount(PLAYERS_PER_GAME);

        // echo "Creating a test play style for game number $intGameNumber\n";
        $objTestHand = new TestHand();
        $objTestStyle = new AggressiveStyle($objTestHand);

        // Deal two cards, face up, to each player. One face up and one face down to the dealer.
        $intCardNum = 0;
        for($intPlayerNum=1; $intPlayerNum<=PLAYERS_PER_GAME; $intPlayerNum++){
            // echo "Processing player $intPlayerNum========================\n";

            // @todo Make this an attribute of a Game object.
            $aResults[$intPlayerNum][$intGameNumber] = array(
                "total" => "",
                "state" => "",
                "result" => "");

            $aNewCards = $objDeck->deal(2);
            $objHand = new TestHand($aNewCards);
            $aPlayerHands[$intPlayerNum] = $objHand;
            $objStyle = $aPlayersToStyles[$intPlayerNum];

            $objStyle->setHand($objHand);

            // For each player in the game, play until a stay, 21, or bust.
            $intTotal = $objHand->getTotal();
            $strDecision = $objStyle->decide();
            $strResult = "";
            while($strDecision != "stay" && $strResult != "bust" && $strResult != "blackjack"){
                $objNext = $objDeck->dealOne();
                // echo "Next:\n" . print_r($objNext, true) . "\n";
                // echo "Total before adding card: $intTotal\n";

                $objHand->addCard($objNext);

                // @todo Store results in an overall structure.
                $intTotal = $objHand->getTotal();
                // echo "Total after adding card: $intTotal\n";
                if($intTotal > 21){
                    // echo "[BUST]\n";
                    $strResult = "bust";
                }
                elseif($intTotal == 21){
                    // echo "[BLACKJACK]\n";
                    $strResult = "blackjack";
                }
                else{
                    $strDecision = $objStyle->decide();
                }

                // echo "Player decided: $strDecision\n";
            }

            $aResults[$intPlayerNum][$intGameNumber]["total"] = $intTotal;
            $aResults[$intPlayerNum][$intGameNumber]["state"] = $strResult;

            // echo "End processing player $intPlayerNum========================\n";
        }

        // echo "Processing dealer========================\n";

        // Process play for dealer.
        $aResults["dealer"][$intGameNumber] = array(
            "total" => "",
            "state" => "",
            "result" => "");
        // @todo Create some mechanism for representing cards as face up/face down. In standard rules, no one would be able to see the dealer's second card.
        $aDealerCards = $objDeck->deal(2);
        $objDealerHand = new TestHand($aDealerCards);
        $objDealerStyle = new DealerStyle($objDealerHand);

        $intTotal = $objDealerHand->getTotal();
        $strDecision = $objDealerStyle->decide();
        $strResult = "";
        while($strDecision != "stay" && $strResult != "bust" && $strResult != "blackjack"){
            $objNext = $objDeck->dealOne();
                // echo "Next:\n" . print_r($objNext, true) . "\n";
                // echo "Total before adding card: $intTotal\n";

                $objHand->addCard($objNext);

                // @todo Store results in an overall structure.
                $intTotal = $objHand->getTotal();
                // echo "Total after adding card: $intTotal\n";
                if($intTotal > 21){
                    // echo "[BUST]\n";
                    $strResult = "bust";
                }
                elseif($intTotal == 21){
                    // echo "[BLACKJACK]\n";
                    $strResult = "blackjack";
                }
                else{
                    $strDecision = $objStyle->decide();
                }

                // echo "Player decided: $strDecision\n";
            }

            // echo "Last dealer decision: $strDecision, total : $intTotal\n";

            $aResults["dealer"][$intGameNumber]["total"] = $intTotal;
            $aResults["dealer"][$intGameNumber]["state"] = $strResult;

            // echo "End processing dealer========================\n";

        // Evaluate results.

        echo "Results:\n" . print_r($aResults, true) . "\n";
    } // Games loop.
}