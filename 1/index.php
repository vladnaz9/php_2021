<?php
if (isset($_REQUEST["code"])) {
    $code = $_POST['code'];
    $param = $_POST['param'];

    $result[0] = "no";

    $lent[0] = 0;
    for ($i = 0; $i <= 15000; $i++) {
        $lent[$i] = 0;
    }
    list($start,$finish) =
    $i = 0; // текущая клетка ленты
    $a = 0;// текущий символ кода
    $j = 0; // текущая клетка результата
    $e = 0; // текущий символ параметра
    $vloj = 0;
    while ($a !== strlen($code)) {
        switch ($code[$a]) :
            case ">" :
                $i++;
                break;
            case "<" :
                $i--;
                break;
            case "+" :
                if ($lent[$i] < 255) {
                    $lent[$i] += 1;
                } else $lent[$i] = 0;
                break;
            case "-" :
                if ($lent[$i] > 0) {
                    $lent[$i] -= 1;
                } else $lent[$i] = 254;
                break;
            case "." :
                $result[$j] = chr($lent[$i]);
                $j++;
                break;
            case "," :
                $lent[$i] = ord($param[$e++]);
                break;
            case "[" :
                $vloj1 = 1;
                if ($lent[$i] == 0) {
                    while ($code[$a] !== "]" && $vloj1 !== 0) {
                        $a++;
                        if ($code[$a] == "[") {
                            $vloj1++;
                        } elseif ($code[$a] == "]") {
                            $vloj1--;
                        }
                    }
                    $a++;
                }
                break;
            case "]" :
                if ($lent[$i] !== 0) {
                    $vloj1 = 1;
                    while ($vloj1 !== 0) {
                        $a--;
                        if ($code[$a] == "]") {
                            $vloj1++;
                        } elseif ($code[$a] == "[") {
                            $vloj1--;
                        }
                    }
                }
                break;
            default:
                $a++;
                break;
        endswitch;
        $a++;
    }
    echo "res: ";
    for ($i = 0; $i < count($result); $i++) {
        echo $result[$i];
    }
}//закрытие if
else {
    require("form.html");
}
