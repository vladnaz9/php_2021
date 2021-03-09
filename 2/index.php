<?php
if (isset($_REQUEST["string"])) {
    $string = $_POST['string'];
    $result = "no";


    function perebor(string $string)
    {
        for ($i = 0; $i < strlen($string); $i++) {
            yield $i;
        }

        echo "кол-во генераций: " . (countMe() - 1);
        echo "<br>";
        echo allInString("");
    }

    function countMe(): int
    {
        static $count = 0;
        $count++;
        return $count;
    }

    function allInString($char): string
    {
        static $result = "";
        $result .= (string)$char;
        return $result;
    }


    $generator = perebor($string);
    foreach ($generator as $index) {
        $newString = str_split($string, $length = 1);
        switch ($newString[$index]) {
            case "h" :
                allInString("4");
                countMe();
                break;
            case "l" :
                allInString("1");
                countMe();
                break;
            case "e" :
                allInString("3");
                countMe();
                break;
            case "o" :
                allInString( "0");
                countMe();
                break;
            default :
                allInString($newString[$index]);
        } //endswitch;
    }
} else {
    require("form.html");
}