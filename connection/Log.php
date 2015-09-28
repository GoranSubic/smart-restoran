<?php
/**
 * Created by PhpStorm.
 * User: Goran
 * Date: 04-Sep-15
 * Time: 12:49
 */
include_once 'db_config.php';

class Log {

    private $handle;
    private $strFileName = LOG_NAME;
    public $dataToLog = '';


    /*
     *@desc Writing to a file
     * @param str $strFileName  The name of the file(from the constant)
     * @param str $dataToLog    Data to be appended to the file
     * @return
     */
    public function WriteLog($dataToLog){

        $this->dataToLog = $dataToLog;

        $this->handle = fopen($this->strFileName, 'a+');

        if(!is_writable($this->strFileName)) die("Check file write permiss for: " .$this->strFileName);

        fwrite($this->handle, "\r\n".$this->dataToLog);
        fclose($this->handle);
    }

    /*
     * @desc    Reading a file
     * @param str $strFileName     The name of the file
     * @return   str     The text file
     */
    public function ReadLog($strFileName){

        $this->checkExists();

        $this->handle = fopen($this->strFileName, 'r');

        return file_get_contents($this->strFileName);

    }

    private function checkExists(){
        if (!file_exists($this->strFileName))
            die('Ne postoji log fajl!');
    }

} 