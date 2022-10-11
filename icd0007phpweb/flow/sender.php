<?php
    if (isset($_GET['text'])) {
        $data =  urlencode('Data was: ' . $_GET["text"]);

        header('Location: receiver.php?text=' . $data);
        exit;
    }
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>

<form action="sender.php">
    <label for="ta">Message:</label>
    <br>
    <textarea id="ta" name="text"></textarea>
    <br>
    <button name="sendButton" type="submit">Send</button>
</form>

</body>
</html>
