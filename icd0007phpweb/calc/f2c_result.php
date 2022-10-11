<?php
$temp = $_POST["temperature"] ?? '';

if (empty($temp)) {
    $message = 'Insert temperature';
} elseif (!is_numeric($temp)) {
    $message = 'Temperature must be an integer';
} else {
    $message = sprintf('%s degrees in Fahrenheit is %s degrees in Celsius', $temp, f2c($temp));
}
function f2c($temp) {
    return (intval($temp) - 32) / (9/5);
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Fahrenheit to Celsius</title>
</head>
<body>

    <nav>
        <a href="index.html" id="c2f">Celsius to Fahrenheit</a> |
        <a href="f2c.html" id="f2c">Fahrenheit to Celsius</a>
    </nav>

    <main>

        <h3>Fahrenheit to Celsius</h3>

        <em><?= $message ?></em><br>

    </main>

</body>
</html>

