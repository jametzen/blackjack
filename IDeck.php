<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 5/13/2018
 * Time: 10:16 PM
 */

interface IDeck
{
    public function addCard(ICard $objCard);
    public function shuffle();
}