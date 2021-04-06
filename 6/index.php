<?php
//if (isset($_REQUEST["form"])) {
//    $form = $_POST['form'];

$context = "index.ini";
$ini = parse_ini_file($context, true, INI_SCANNER_NORMAL);
$fileAddress = $ini['main']['filename'];

$opened = fopen($fileAddress, "r+t", $use_include = false);
//var_dump($ini);

//rules
$firstRule = $ini['first_rule'];
$secondRule = $ini['second_rule'];
$thirdRule = $ini['third_rule'];
//symbols
$firstSymbol = $firstRule['symbol'];
$secondSymbol = $secondRule['symbol'];
$thirdSymbol = $thirdRule['symbol'];
//tags
$upper = $firstRule['upper'];
$direction = $secondRule['direction'];
$delete = $thirdRule['delete'];

while (!feof($opened)) {
    echo "<br>";
    $string = fgets($opened);
//    echo $string;
    if (substr($string, 0, strlen($firstSymbol)) === $firstSymbol) {
        if ($upper === true) {
            echo strtoupper($string);
        } else echo strtolower($string);
    } elseif (substr($string, 0, strlen($secondSymbol)) === $secondSymbol) {
        for ($i = 0; $i < strlen($string) - 1; $i++) {
            $tmpSymbol = substr($string, $i, 1);
            if (ctype_digit($tmpSymbol)) { // IntlChar::isdigit()
                $digit = (int)$tmpSymbol;
                if ($direction === "+") {
                    if ($digit < 9)
                        $digit += 1;
                    else $digit = 0;
                } else {
                    if ($digit > 0) {
                        $digit -= 1;
                    } else $digit = 9;
                }
                $string = substr_replace($string, $digit, $i, 1);
            }
        }
        echo $string;
    } elseif (substr($string, 0, strlen($thirdSymbol)) === $thirdSymbol) {
            $string = str_replace($delete,"",$string);
            echo $string;
        } else echo $string;
}
//} else require "form.html";