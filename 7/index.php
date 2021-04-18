<?php

if (isset($_REQUEST["form"])) {
    $address = $_POST['form'];
//    $box[] = $_POST['box'];
    $flag1 = false;
    $flag2 = false;
    if (isset($_POST['tracert'])) {
        $tracert = $_POST['tracert'];
        $flag1 = true;
    }
    if (isset($_POST['ping'])) {
        $flag2 = true;
        $ping = $_POST['ping'];
    }
    if ($flag2) {
        $dns = dns_get_record($address);
        $ip = '';
//       var_dump(dns_get_record($address));
        for ($i = 0; $i < 5; $i++) {
            if (isset($dns[$i]["ip"])) {
                $ip = $dns[$i]["ip"];
//                $ip = "<b>".$ip."</b>";
            }
        }
//        echo $ip;
//        echo "<br>";

        //через proc_open

//        $spec = array(
//            0 => array("pipe","r"),
//            1 => array("pipe","w"),
////            2 => array("file", "/tmp/error-output.txt", "a")
//        );
//       $process = proc_open("ping $ip", $spec,$pipes);
//       $value =  proc_close($process);
//       echo stream_get_contents($pipes[0]);
        if ($ip === "") {
            echo "попробуйте еще раз или введен неправильный адрес";
        } else {
            exec("ping $ip", $output, $status);
            $regForPing = '/[0-9]?[0-9]%/';
//            var_dump($output);

            $string[] = $output[9];

            $result = preg_grep($regForPing, $string);
            $string1 = $result[0];
//            echo $string1;
//        var_dump($string1);
            echo "<br>";
            $string2 = "";
            $string2 = substr($string1, 5, 3);
            echo '<b>' . $ip . "   </b>";
            echo $string2 . " потеряно";


        }
    }

    if ($flag1) {
        if ($flag2) {
            sleep(8);
            echo "<br>";
        }
        $dns = dns_get_record($address);
        $ip = '';
//       var_dump(dns_get_record($address));
        for ($i = 0; $i < 5; $i++) {
            if (isset($dns[$i]["ip"])) {
                $ip = $dns[$i]["ip"];
//                $ip = "<b>".$ip."</b>";
            }
        }
        if ($ip === "") {
            echo "попробуйте еще раз или введен неправильный адрес";
        } else {
//        echo $ip;
            echo "tracert: <br>";
            exec("tracert $ip", $output);
//        print_r($output);
            $reg = "/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}/";
            $result = preg_grep($reg, $output);
//        print_r($result);
            foreach ($result as $str) {
//            echo $str;
                $myArray = array();
//            print_r(preg_split($reg,$str));
                $myArray = explode(" ", $str);
                $x = $myArray[array_key_last($myArray)];
                if (!(substr($x, 0,3) === "TTL")) {
                    echo "<b>" . $x . "</b>";
                    echo "<br>";
                }
            }
        }
//        print_r(explode(" ", " 8 33 ms 24 ms 28 ms yandex.ru"))
    }


}//закрытие if
else {
    require("form.html");
}
