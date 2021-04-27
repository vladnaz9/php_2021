<?php
include_once("FileLogger.php");
include_once ("BrowserLogger.php");

if (isset($_REQUEST["form"])) {
    if (isset($_POST["option1"])) {
        $checked = $_POST["option1"];
        if ($checked == 1) {
            $file = $_POST["file"];
            $logger = new FileLogger($file);
        } else {
            $dataInfo = $_POST["data"][0];
            $logger = new BrowserLogger($dataInfo);
            $logger->writeString($_POST["form"]);
        }
    }
}//закрытие if
else {
    require("form.html");
}
