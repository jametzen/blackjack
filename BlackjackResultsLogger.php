<?php
/**
 * Created by PhpStorm.
 * User: jerem
 * Date: 5/20/2018
 * Time: 11:54 AM
 */

class BlackjackResultsLogger implements ILogger
{
    private $aBuffer;
    private $strTextFile;

    public function __construct($strTextFile)
    {
        $this->strTextFile = $strTextFile;
        $this->aBuffer = array();
    }

    public function log()
    {
        $objFH = fopen($this->strTextFile, "w");

        foreach($this->aBuffer as $intIndex => $aItem){
            foreach($aItem as $strKey => $mxItem){
                fwrite($objFH, "$strKey => $mxItem,");
            }

            write($objFH, PHP_EOL);
        }

        fclose($objFH);
    }

    public function queueSet(array $aSet)
    {
        $this->aBuffer[] = $aSet;
    }
}