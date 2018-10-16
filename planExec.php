<?php

include_once('setDiffLib.php');
include_once('planListLib.php');
include_once('madeScenario.php');

class planExec
{
    public $planListLib;
    public $aReq;
    public $setDiffLib;
    public $madeScenario;

    public function __construct($aReq)
    {
        $this->planListLib = new planListLib($aReq);
        $this->setDiffLib = new setDiffLib($aReq['aFiles']);
        
    }

    public function setList()
    {
        $aSetListResult = $this->planListLib->setList();
        $aSetTarListResult = $this->planListLib->setTarList($aSetListResult);
        $aSetCPListResult = $this->planListLib->setCPList($aSetListResult);

        $aSetListReturn = array(
            'aWindowFileList' => $aSetListResult['aWindowFileList'],
            'aLinuxFilstList' => $aSetListResult['aLinuxFilstList'],
            'aTarList' => $aSetTarListResult['aTarList'],
            'aCPList' => $aSetCPListResult['aCPList'],
            'jira_code' => $this->planListLib->aReq['jira_code'],
        );

        $this->madeScenario = new madeScenario($aSetListReturn);
        $aResult = $this->madeScenario->openDefaultScenario();
        $this->madeScenario->replaceScenario($aResult);

        return $aSetListReturn;
    }

    public function setDiff()
    {
        $aResult = $this->setDiffLib->openDiffFile();
        $aResult = $this->setDiffLib->setReplace($aResult);
        $aReturn = array(
            'sFileName' => $aResult['sFileName'],
        );
        return $aReturn;
    }
}




$aParam = array(
    'aReq' => $_POST,
    'aFiles' => $_FILES,
);
$planExec = new planExec($aParam);
$aSetListResult = $planExec->setList();
$aResult = $planExec->setDiff();
$sFileName = $aResult['sFileName'];

$aWindowFileList = $aSetListResult['aWindowFileList'];
$aLinuxFilstList = $aSetListResult['aLinuxFilstList'];
$aTarList = $aSetListResult['aTarList'];
$aCPList = $aSetListResult['aCPList'];
$jira_code = $aSetListResult['jira_code'];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title> 배포시나리오 생성 </title>
<meta charset="UTF-8">
<meta name="description" content="Free Web tutorials">
<meta name="keywords" content="HTML,CSS,XML,JavaScript">
<meta name="author" content="Hege Refsnes">
 </head>

 <body>
<a href="download.php?param=1">diff 파일 링크</a><br />
<a href="download.php?param=2">시나리오 파일 링크</a>

 </body>
</html>
