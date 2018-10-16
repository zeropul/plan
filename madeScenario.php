<?php

class madeScenario
{
    public $aParam;
    public function __construct($aParam = array())
    {
        $this->aParam = $aParam;
    }

    public function openDefaultScenario()
    {
        $oHandle = fopen('defaultScenario.txt', 'r');
        $sDefaultScenario = '';
        while ($sDiffFileLine = fread($oHandle, 8192)) {
            $sDefaultScenario .= $sDiffFileLine; 
        } 
        fclose($oHandle); 

        $aReturn = array(
            'sDefaultScenario' => $sDefaultScenario,
        );
        return $aReturn; 
    }

    public function replaceScenario($aPlaceScenarioParam = array())
    {
        $sDefaultScenario = $aPlaceScenarioParam['sDefaultScenario'];
        foreach ($this->aParam as $sKey1 => $aVal1) {
            if (is_array($aVal1) === true && count($aVal1) > 0) {
                $sReplacement = '';
                foreach ($aVal1 as $iKey2 => $sVal2) {
                    $sReplacement .= $sVal2."\n";
                }
                $sDefaultScenario = str_replace($sKey1, $sReplacement, $sDefaultScenario);
            } else {
                $sReplacement = $aVal1;
                $sDefaultScenario = str_replace($sKey1, $sReplacement, $sDefaultScenario);
            }
        }


        $sScenario = 'scenario.txt';
        $oHandle = fopen($sScenario, 'w+'); 
        fwrite($oHandle, $sDefaultScenario); 
        fclose($oHandle);
    }
}
