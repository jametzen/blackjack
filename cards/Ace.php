<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 5/13/2018
 * Time: 11:09 AM
 */

require_once("IBicycleCard.php");

// @note Not sure I like having a separate class for each card, but this does keep classes very small and specific.
// I suppose I could get even further and make a separate class for each suite, so this isn't even as small as things
// could be broken down.
class Ace implements IBicycleCard
{
    private $strSuite;
    private $intValue;

    public function __construct($strSuite)
    {
        $this->strSuite = $strSuite;
    }

    // Specifically for Aces.
    public function setValue($intValue)
    {
        $this->intValue = $intValue;
    }

    public function getValue()
    {
        // @note Aces are special in particular, could return one of two values.
        return 1;
    }

    // Placeholder. @note Might violate SOLID: Might have to change class if methodology for images changes at all.
    public function getImg()
    {
        return "";
    }
}