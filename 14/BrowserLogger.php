<?php

include_once ("Logger.php");
include ("php_2021/docs/phpDocumentor.phar");
/**
 * Class BrowserLogger
 */

class BrowserLogger extends Logger
{
    /**
     * @var string
     * @author
     */
    public string $DInfo;

    /**
     * BrowserLogger constructor.
     * @param string $DInfo
     */
    public function __construct(string $DInfo)
    {
        $this->DInfo = $DInfo;
    }

    /**
     * @param $string
     * @throws Exception
     */
    public function writeString($string)
    {

            $date = new DateTime("now", new DateTimeZone("Europe/Moscow"));
//            echo "ошибка времени, попробойте еще раз";

        switch ($this->DInfo) {
            case "d":
                echo "[" . date_format($date, "Y-m-d") . "] " . $string . "<br>";
                break;
            case "d+t":
                echo "[" . $date->format(DATE_RFC822) . "] " . $string . "<br>";
                break;
            case "no":
                echo $string;
                break;
        }
    }
}