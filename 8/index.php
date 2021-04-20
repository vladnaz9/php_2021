<?php

if (isset($_REQUEST["form"])) {
    if (isset($_POST["want"])) {
        $checked = $_POST["want"];
    } else $checked = 'false';
    if ($checked === "on") {
        $month = explode(" ", $_POST["month"])[1];
        $date = new DateTime("2021-$month-01 00:00:00");
        $today = 0;
    } else {
        $date = new DateTime('now', new DateTimeZone("Europe/Moscow"));
        $today = explode(" ", $date->format(DateTime::RSS))[1];
        $i1 = 0;
        if ($today != 1) {
            $i1 = $today - 1;
        }

        $date = $date->modify("-$i1 day");
    }
    $firstDay = explode(" ", $date->format(DateTime::RSS))[0];
    echo $firstDay;
    echo "<link rel='stylesheet' href='style.css'>";
    echo explode(" ", $date->format(DateTime::RSS))[2];


    echo '<table>
    <tr>
        <th>пн</th> <th>вт</th> <th>ср</th>
        <th>чт</th> <th>пт</th>  <th class="weekend">сб</th> <th class="weekend">вс</th>
    </tr>';
    $dateArray = date_parse($date->format(DateTime::RSS));
    $number = cal_days_in_month(CAL_GREGORIAN, $dateArray["month"], $dateArray["year"]);
    $firstOfWeekDay = $dateArray["relative"]["weekday"];

    echo "<tr>";

    for ($i = 1; $i <= $number; $i++) {

        if ($i == 1 && $firstOfWeekDay !== 1) {
            for ($j = 1; $j < $firstOfWeekDay; $j++) {
                echo "<td>  </td>";
            }
        }
        $class = "";
        if (($firstOfWeekDay + $i - 1) % 7 > 5 || ($i + $firstOfWeekDay - 1) % 7 == 0) {
            $class = "class='weekend'";
        }
//        if ($i < 0) {
//            echo "<td>  </td>";
//        } else
        if (($i + $firstOfWeekDay - 1) < 10) {
            if ($i == $today){
                echo "<th $class> $i</th>";
            } else
            echo "<td $class> $i</td>";
        } else{
            if ($i == $today){
                echo "<th $class> $i</th>";
            } else
            echo "<td $class>$i</td>";
        }
        if (($i + $firstOfWeekDay - 1) % 7 == 0) {
            echo "</tr>";
            if ($i != $number) {
                echo "<tr>";
            }
        }
    }
//    echo $firstDay;

    echo "</table>";
}//закрытие if
else {
    require("form.html");
}