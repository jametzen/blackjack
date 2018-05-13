<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 5/12/2018
 * Time: 2:20 PM
 */

// @note If I use this, it will likely only be to illustrate the "has a" property of object composition: A player "has a" play style.
interface IPlayer
{
    // public function __construct($strName, IPlayStyle $objStyle);
    public function play();
}