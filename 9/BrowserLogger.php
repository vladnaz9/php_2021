<?php


class BrowserLogger extends Logger
{
    private string $DInfo;

    public function __construct(string $DInfo)
    {
        $this->DInfo = $DInfo;
    }

    public function writeString($string)
    {
        try {
            $date = new DateTime("now", new DateTimeZone("Europe/Moscow"));
        } catch (Exception $e) {
            echo "ошибка времени, попробойте еще раз";
            return;
        }
        switch ($this->DInfo) {
            case "d":
                echo "[" . date_format($date, "Y-m-d") . "]" . $string;
                break;
            case "d+t":
                echo "[" . $date->format(DATE_RFC822) . "]" . $string;
                break;
            case "no":
                echo $string;
                break;
        }
    }
}