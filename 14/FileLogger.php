<?php
include_once("Logger.php");
/**
 * Class FileLogger
 * @author
 */
class FileLogger extends Logger
{
    /**
     * @var string
     */
    public string $fileName;
    protected $opened;

    /**
     * FileLogger constructor.
     * @param string $fileName
     */
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
        $this->opened = fopen($this->fileName, "w+");
    }

    /**
     * @param $string
     */
    public function writeString($string)
    {
        fwrite($this->opened, $string);
//        fwrite($this->opened,"\n");

    }

    /**
     *
     */
    public function __destruct()
    {
        fclose($this->opened);
    }


}