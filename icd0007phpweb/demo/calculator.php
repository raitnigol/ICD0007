<?php

$temp = $_GET['temp_in_celsius'];

print toFahrenheit(intval($temp));

function toFahrenheit($temp): float {
    return $temp * 9 / 5 + 32;
}
