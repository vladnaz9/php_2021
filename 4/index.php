<?php

if (isset($_REQUEST["form"])) {
    $form = $_POST['form'];

    $strings = explode(PHP_EOL, $form);
    $sum = 0;
    $data = [];

    foreach ($strings as $s1) {
        $length = strlen($s1);
        $weight = (int) $s1[$length - 1];

//        echo $weight.' ';
//        echo $s."<br>";
        $sum += $weight;
    }
    $forJson["sum"] = $sum;

    foreach ($strings as $s) {
        $weight =(int) $s[strlen($s) - 1];
        $s = substr($s, 0, -1);
        $data[] = [
            "text" => $s,
            "weight" => $weight,
            "probability" => ($weight / $sum)
        ];
//        echo ($weight / $sum)."<br>";
    }
    $forJson["data"] = $data;
    echo json_encode($forJson, JSON_UNESCAPED_UNICODE);

    //------------ВТОРОЕ ЗАДАНИЕ-------------------

    foreach ($strings as $s) {
        $weight = (int) $s[strlen($s) - 1];
        $s = substr($s, 0, -1);
        $newData[] = [
            0 => $s,
            1 => ($weight / $sum)
        ];
    }
//    var_dump($newData);

    function randomGenerator($newData)
    {
//         asort($newData);
        $chances = [];
        $range = [];
        $sumOfRange = 0;
        foreach ($newData as $datum) {
//            var_dump($datum)."<br>";
            list($text,$probability) = $datum;

//            echo $sumOfRange."    +  ";
//            echo $probability."  =   ";
            $sumOfRange += round( $probability * 10000, 0);
//            echo $sumOfRange." <br>";
            $chances[] = $sumOfRange;
            $range[$sumOfRange] = $text;
//            var_dump($range)."<br>";
        }
//        echo "<br>";
//        var_dump($newData);
        $random = mt_rand(0, 10000) ;
//        if ($random < 0.7) //для оптимальности
        var_dump($random);
        $last = 0;
        foreach ($chances as $ch) {
//            echo $ch."<br>";
            if ($random > $ch ) {
                $last = $ch;
                continue;
            } else {
                $chance = ($ch - $last) / 10000;
                yield [
                    "text" => $range[$ch],
                    "chance" => $chance
                ];
                break;
            }
        }

    }

    foreach (randomGenerator($newData) as $result) {
        echo $result["text"]."  with chance: ";
        echo $result["chance"];
        return $result;
    }


    function check( $to ,$newData) : array {
        $result = [];
        for ($i = 0; $i < $to; $i++) {
            $randomed = randomGenerator($newData) -> getReturn();
//            var_dump($randomed)."<br>";
            if (in_array($randomed,$result)) {
                $key = array_search($randomed,$result);
                list($text,$count) = $result[$key];
                $count++;
                $result[$key] = [
                    "text" => $text,
                    "count" => $count,
                    "calculated_probability" => $count / $to
                ];
            } else {
                $result[] = [
                    "text" => $randomed,
                    "count" => 1
                ];
            }
        }
        return $result;
    }
    check(10000,$newData);
  echo json_encode(check(10000,$newData),JSON_UNESCAPED_UNICODE);


}//закрытие if
else {
    require("form.html");
}