<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 5/13/2018
 * Time: 12:33 AM
 */

require_once("ICard.php");

interface IBicycleCard extends ICard
{
    // @note Going to take suite and similar through constructor for now, though that may technically violate SOLID.
    public function getValue();
    // public function getImg(); // Just so I don't have to implement this in every class, for now.
}