<?php

if (isset($_REQUEST["string"])) {
    $string = $_POST['string'];

    $data = explode(PHP_EOL, $string);

    $a = [];
    for ($i = 0; $i < count($data); $i++) {
        $a[$i] = explode(" ", $data[$i]);
        shuffle($a[$i]);
        $data[$i] = explode(" ", $data[$i]);
//        $a[$i] = implode( " ", $a[$i]);
        echo "<br/>";
    }

    $a = array_merge($a, $data);
//    var_dump($a);
    echo "<br/>";

    function custom_sort(array $a1, array $a2)
    {
        return strcmp($a1[1], $a2[1]);  // если нужно будет без регистра, используем strcasecmp
    }

    usort($a, "custom_sort");
    foreach ($a as $value) {
        $value = implode(" ", $value);
        echo $value . "<br/>";
    }

}//закрытие if
else {
    require("form.html");
}