<?php

if (isset($_REQUEST["form"])) {
    $form = $_POST['form'];

    $strings = explode(PHP_EOL, $form);
    $sum = 0;
    $data = [];

    foreach ($strings as $s1) {
        $length = strlen($s1);
        $weight = (int)$s1[$length - 1];
        $sum += $weight;
    }
    $forJson["sum"] = $sum;

    foreach ($strings as $s) {
        $weight = (int)$s[strlen($s) - 1];
        $s = substr($s, 0, -1);
        $data[] = [
            "text" => $s,
            "weight" => $weight,
            "probability" => ($weight / $sum)
        ];
    }
    $forJson["data"] = $data;
    echo json_encode($forJson, JSON_UNESCAPED_UNICODE);
    echo "<br>";
    //------------ВТОРОЕ ЗАДАНИЕ-------------------

    foreach ($strings as $s) {
        $weight = (int)$s[strlen($s) - 1];
        $s = substr($s, 0, -1);
        $newData[] = [
            0 => $s,
            1 => ($weight / $sum)
        ];
    }
//    var_dump($newData);

    function randomGenerator($newData)
    {
        $chances = [];
        $range = [];
        $sumOfRange = 0;

        foreach ($newData as $datum) {
            list($text, $probability) = $datum;
            $sumOfRange += round($probability * 10000, 0);
            $chances[] = $sumOfRange;
            $range[$sumOfRange] = $text;
        }

        $random = mt_rand(0, 10000);
//        echo $random."<br>";
//        if ($random < 0.7) //для оптимальности
//        var_dump($random);
        $last = 0;
        $result = [];
        foreach ($chances as $ch) {
//            echo $ch."<br>";
            if ($random > $ch) {
                $last = $ch;
                continue;
            } else {
                $chance = ($ch - $last) / 10000;
//                yield [
//                    "text" => $range[$ch],
//                    "chance" => $chance
//                ];
                $result = [
                    "text" => $range[$ch],
                    "chance" => $chance
                ];
                break;
            }
        }

        return $result;
    }


//    foreach (randomGenerator($newData) as $result) {
//        echo $result["text"] . "  with chance: ";
//        echo $result["chance"];
//        return $result;
//    }
    echo "<br>";


    function check($to, $newData): array
    {
        $result = [];
        for ($i = 0; $i < $to; $i++) {
            $randomed = randomGenerator($newData);
//            var_dump($randomed);
            $RandomedText = $randomed["text"];
            $flag = false;
            $myKey = 0;
            $count = 1;
            foreach ($result as $key => $text){
                if (!empty($result)) {
                    if ($text["text"] == $randomed["text"]) {
                        $flag = true;
                        $myKey = $key;
                        $count = $text["count"];
                        break;
                    }
                }
            }
            if ($flag) {
                $count++;
                $result[$myKey] = [
                    "text" => $RandomedText,
                    "count" => $count,
                    "calculated_probability" => ($randomed["chance"] * $to)
                ];
            } else {
                $result[] = [
                    "text" => $RandomedText,
                    "count" => 1,
                    "calculated_probability" => ($randomed["chance"] * $to)
                ];
            }
        }
        return $result;
    }

    echo json_encode(check(10000, $newData), JSON_UNESCAPED_UNICODE);


}//закрытие if
else {
    require("form.html");
}