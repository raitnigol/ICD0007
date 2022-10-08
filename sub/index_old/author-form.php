<?php
#var_dump($_POST);
if (isset($_POST['firstName'])) {
    $first_name = $_POST['firstName'];

    if (strlen($first_name) < 1) {
        $first_name_error = true;
        echo $first_name;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Nigol's Lair</title>
</head>
<body id="book-list-page">
    <div id="root">
        <nav>
            <div>
                <a href="?cmd=book-list" id="book-list-link">Raamatud</a>
                <span>|</span>
                <a href="?cmd=book-form" id="book-form-link">Lisa raamat</a>
                <span>|</span>
                <a href="?cmd=author-list" id="author-list-link">Autorid</a>
                <span>|</span>
                <a href="?cmd=author-form" id="author-form-link">Lisa autor</a>
            </div>
        </nav>
        <main>
            <div id="error-block">
                Eesnimi peab olema 1 kuni 21 märki!
                <br>
                Perekonnanimi peab olema 2 kuni 22 märki!
            </div>
        <form id="input-form" method="post">
            <input name="id" type="hidden" value="">

        <div class="label-cell">
            <label for="name">Eesnimi:</label>
        </div>
        <div class="input-cell">
            <input id="name" name="firstName" value="" type="text">
        </div>

        <div class="label-cell">
            <label for="last-name">Perkonnanimi:</label>
        </div>
        <div class="input-cell">
            <input id="last-name" name="lastName" value="" type="text">
        </div>

        <div class="label-cell">Hinne: </div>
        <div class="input-cell">
            <label>
                <input type="radio" name="grade" value="1">1
            </label>
            <label>
                <input type="radio" name="grade" value="2">2
            </label>
            <label>
                <input type="radio" name="grade" value="3">3
            </label>
            <label>
                <input type="radio" name="grade" value="4">4
            </label>
            <label>
                <input type="radio" name="grade" value="5">5
            </label>
        </div>

        <div class="flex-break"></div>

        <div class="label-cell"></div>
        <div class="input-cell button-cell">
            <input name="submitButton" type="submit" formaction="?cmd=author-save" value="Salvesta">
        </div>
</form>
        </main>
        <footer>ICD0007 Rakendus</footer>
    </div>
</body>
</html>