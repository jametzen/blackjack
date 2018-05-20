<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 5/19/2018
 * Time: 3:20 PM
 */

define("NUM_PLAYERS", 5);

if(count($argv) == 2){
    $intNumGames = $argv[1];

    $objGame = new BlackjackGame();

    // This will probably need to be an interface.
    $objResults = new BlackjackResultsLogger("blackjack-run-" . time() . ".txt");

    // @todo Determine where the boundary between games/hands/players is. Do you instantiate a new Game with every hand?
    // Do you just call something like game->start() or game->deal()?
    // I think I'm going to stick with my initial method of separating hands from games. So the same game object will
    // be used throughout, while creating new hands.
    for($i=1;$i<=NUM_PLAYERS;$i++){
        // Every x number of players are going to be attributed a different play style.
        // @note Remember that a play style needs to be able to look at the entire game, ideally.
        $objPlayStyle = null;

        if($i % 2 == 0){
            $objPlayStyle = new BalancedStyle();
        }
        elseif($i % 3 == 0){
            $objPlayStyle = new AggressiveStyle();
        }
        elseif($i % 4 == 0){
            $objPlayStyle = new ConservativeStyle();
        }
        else{
            $objPlayStyle = new RandoStyle();
        }

        $objPlayer = new BlackjackPlayer($objPlayStyle);

        $objGame->addPlayer($objPlayer);
    }

    $objDealer = new BlackjackDealer(new DealerStyle());

    // @todo Figure out how to generate a random play style here without resorting to dynamic variables and the like.
    for($i=1;$i<=$intNumGames;$i++){
        // @note Dependency is a bit weird here. Normally I'd be inclined to tell the game to deal a new hand.
        $objHand = new BlackjackHand($objGame);
        // Alternatively.
        $objGame->dealHand($objHand);

        while(!$objGame->isFinished()){
            $objGame->getPlayerInput();
        }

        $objWinner = $objGame->getWinner(); // Should return a player.
        $intTotal = $objGame->getPlayerTotal($objWinner);

        // @todo Possibly figure out a way to retrieve all other player data, so you could determine how often a
        // given style busts, etc.

        // Going to log this stuff as simple key/value pairs.
        $objResults->queueSet(array(
            "winner" => $objWinner->getPlayerNumber(),
            "score" => $intTotal
        ));
    }

    $objResults->log();
}