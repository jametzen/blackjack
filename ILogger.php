<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 5/20/2018
 * Time: 11:52 AM
 */

interface ILogger
{
    public function log();
    public function queueSet(array $aSet);
}