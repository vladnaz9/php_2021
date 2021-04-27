<?php


class FileLogger extends Logger
{
    public String $fileName;
    protected $opened;
    public function __construct(String $fileName)
    {
        $this->fileName = $fileName;
        $this->opened = fopen($this->fileName,"w+");
    }

    public function writeString($string)
    {
        fwrite($this->opened,$string);
//        fwrite($this->opened,"\n");

    }

   public function __destruct()
    {
        fclose($this->opened);
    }



}