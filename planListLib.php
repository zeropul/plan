<?php
class planListLib
{
    public $aReq;
    public $sJiraCode;
    public function __construct($aReq)
    {
        $this->aReq = $aReq['aReq'];
        $this->sJiraCode = $aReq['aReq']['jira_code'];
    }


    /**
     * 리눅스 파일 경로 생성
     */
    public function setList($aSetListParam = array())
    {
        $aPattern = array(
            "\r",
            "\r\n",
        );
        $sFileList = str_replace($aPattern, '', $this->aReq['file_list']);
        
        $aFileList = explode("\n", $sFileList);

        if (is_array($aFileList) === false && count($aFileList) < 1) {
            return false;
        }

        //$aPatternStr = array('\\\\', 'C:/stylenanda');
        $aPatternStr = array('\\\\', 'C:/stylenanda', 'C:/shop19/dev1/12r', 'C:/shop19/dev2/12r', 'C:/shop19/dev1', 'C:/shop19/dev2');
        $aReplaceStr = array('/', '/home', '/home/12r', '/home/12r', '/home', '/home');
        $aLinuxFilstList = array();

        foreach ($aFileList as $iKey1 => $sVal1) {
            if (trim($sVal1) == '') {
                unset($aFileList[$iKey1]);
                continue;
            }
            $aLinuxFilstList[$iKey1] = str_replace($aPatternStr, $aReplaceStr, $sVal1);
            $aWindowFileList[$iKey1] = str_replace('\\\\', '\\', $sVal1);
        }

        $aReturn = array(
            'aWindowFileList' => $aWindowFileList,
            'aLinuxFilstList' => $aLinuxFilstList,
        );

        return $aReturn;
    }

    /**
     * tar 명령어 생성
     */
    public function setTarList($aSetTarListParam = array())
    {
        $aLinuxFilstList = $aSetTarListParam['aLinuxFilstList'];
        if (is_array($aLinuxFilstList) === false || count($aLinuxFilstList) < 1) {
            return false;
        }
        $aTarList = array();

        foreach ($aLinuxFilstList as $iKey1 => $sVal1) {
            if ($iKey1 < 1) {
                $aTarList[] = str_replace('/home', 'tar cvf '.$this->sJiraCode.'.tar .', trim($sVal1)).';';
            } else {
                $aTarList[] = str_replace('/home', 'tar rvf '.$this->sJiraCode.'.tar .', trim($sVal1)).';';
            }
        }

        $aReturn = array(
            'aTarList' => $aTarList,
        );
        return $aReturn;
    }

    /**
     * cp 명령어 생성
     */
    public function setCPList($aSetCPListParam = array())
    {
        $aLinuxFilstList = $aSetCPListParam['aLinuxFilstList'];
        if (is_array($aLinuxFilstList) === false || count($aLinuxFilstList) < 1) {
            return false;
        }
        $aCPList = array();
        $aPatterns = array(
            //'/^\/[a-z]+\/[a-z\.\_*\/[a-z]*\//i',
            '/^\/[a-z]+\/[0-9a-zA-Z]*\/[a-zA-Z\.\_*\/[a-zA-Z]*\//i',
        );

        foreach ($aLinuxFilstList as $iKey1 => $sVal1) {           
            $sFileName = preg_replace($aPatterns, '', trim($sVal1));
            $aCPList[] = '\cp -a '.$sFileName.' '.$sVal1;
        }

        $aReturn = array(
            'aCPList' => $aCPList,
        );
        return $aReturn;
    }

    public function setFrame()
    {

    }
}