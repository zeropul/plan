<?php

/**
 * diff 파일 자동 생성
 */
class setDiffLib
{
    public $aFiles;
    public function __construct($aFiles)
    {
        $this->aFiles = $aFiles;
    }

    public function openDiffFile()
    {
        if ($this->aFiles['diff_file']['tmp_name'] == '') {
            return false;
        }
        $oHandle = fopen($this->aFiles['diff_file']['tmp_name'], 'r');
        $sDiffContents = '';
        while ($sDiffFileLine = fread($oHandle, 8192)) {
            $sDiffContents .= $sDiffFileLine; 
        } 
        fclose($oHandle); 

        $aReturn = array(
            'sDiffContents' => $sDiffContents,
        );
        return $aReturn; 
    }

    public function setReplace($aSetReplaceParam)
    {
        $sDiffContents = $aSetReplaceParam['sDiffContents'];

        $aPatterns = array(
            '/diff -r [a-z\d]* -r [a-z0-9]* /',
            '/\{expand:([a-zA-Z0-9_.\/]*\.php)[\r\n]/i',
            '/\{expand:([a-zA-Z0-9_.\/]*\.js)[\r\n]/',
            '/\{expand:([a-zA-Z0-9_\/]*\.tpl)[\r\n]/',
            '/\{expand:([a-zA-Z0-9_\/]*\.html)[\r\n]/',
            '/\{expand:([a-zA-Z0-9_.\/]*\.xml)[\r\n]/',
            '/\{expand:([a-zA-Z0-9_.\/]*\.ini)[\r\n]/',
            '/\{expand:([a-zA-Z0-9_\/]*\.css)[\r\n]/',
            '/\{expand:([a-zA-Z0-9_\/]*\.py)[\r\n]/',
        );
        $aReplace = array(
            "        {code}\n        {expand}\n        {expand:",
            '{expand:\1}'."\n".'        {code:php|borderStyle=solid|borderColor=Gainsboro|bgColor=white|titleBGColor=green}'."\n",
            '{expand:\1}'."\n".'        {code:js|borderStyle=solid|borderColor=Gainsboro|bgColor=white|titleBGColor=green}'."\n",
            '{expand:\1}'."\n".'        {code:tpl|borderStyle=solid|borderColor=Gainsboro|bgColor=white|titleBGColor=green}'."\n",
            '{expand:\1}'."\n".'        {code:html|borderStyle=solid|borderColor=Gainsboro|bgColor=white|titleBGColor=green}'."\n",
            '{expand:\1}'."\n".'        {code:xml|borderStyle=solid|borderColor=Gainsboro|bgColor=white|titleBGColor=green}'."\n",
            '{expand:\1}'."\n".'        {code:ini|borderStyle=solid|borderColor=Gainsboro|bgColor=white|titleBGColor=green}'."\n",
            '{expand:\1}'."\n".'        {code:css|borderStyle=solid|borderColor=Gainsboro|bgColor=white|titleBGColor=green}'."\n",
            '{expand:\1}'."\n".'        {code:py|borderStyle=solid|borderColor=Gainsboro|bgColor=white|titleBGColor=green}'."\n",
        );

        foreach ($aPatterns as $iKey1 => $sVal1) {
            $sDiffContents = preg_replace($sVal1, $aReplace[$iKey1], $sDiffContents);
        }


        $sDiffFileName = 'diff.txt';
        $oHandle = fopen($sDiffFileName, 'w+'); 
        fwrite($oHandle, $sDiffContents); 
        fclose($oHandle);

        $aFileContent = file($sDiffFileName);//file in to an array
        $aFirstAndSecondLine = array($aFileContent[0], $aFileContent[1]);

        $oHandle = fopen($sDiffFileName, 'w+');
        for ($i = 2; $i<=count($aFileContent); $i++) {
            fwrite($oHandle, $aFileContent[$i]); 
        }
        fclose($oHandle); 

        $oHandle = fopen($sDiffFileName, 'a');
        foreach ($aFirstAndSecondLine as $iKey1 => $sVal1) {
            fwrite($oHandle, $sVal1);
        }
        fclose($oHandle);

        chmod($sDiffFileName, 0777);
        chown($sDiffFileName, 'nobody');
        chgrp($sDiffFileName, 'nobody');

        $aReturn = array(
            'sFileName' => $sDiffFileName,
        );
        return $aReturn;
    }
}