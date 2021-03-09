<?php
if (isset($_REQUEST["string"])) {
    $string = $_POST['string'];
    $result = "no";


    function perebor(string $string)
    {
        for ($i = 0; $i < strlen($string); $i++) {
            yield $i;
        }
        echo "<br>";
        echo "кол-во генераций :".(countMe() - 1);
    }

    function countMe(): int
    {
        static $count = 0;
        $count++;
        return $count;
    }


    $generator = perebor($string);
    foreach ($generator as $index) {
        $newString = str_split($string, $length = 1);
        switch ($newString[$index]) {
            case "h" :
                echo "4";
                countMe();
                break;
            case "l" :
                echo "1";
                countMe();
                break;
            case "e" :
                echo "3";
                countMe();
                break;
            case "o" :
                echo "0";
                countMe();
                break;
            default :
                echo $newString[$index];
        } //endswitch;
    }
} else {
    require("form.html");
}