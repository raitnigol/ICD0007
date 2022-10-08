<?php
#var_dump($_GET);
#var_dump($_POST);
// set first & last name errors to false by default
$first_name_error = false;
$last_name_error = false;

if (isset($_POST['firstName'])) {
    $first_name = $_POST['firstName'];

    if (strlen($first_name) < 1) {
        $first_name_error = true;
    }
}

if (isset($_POST['lastName'])) {
    $last_name = $_POST['lastName'];

    if (strlen($last_name) < 2) {
        $last_name_error = true;
    }
}
if (!$first_name_error && !$last_name_error) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // write to file logic (append to fake database file)
        $database_file = fopen('database/authors_data.txt', 'a');
        // -> create the appendable data
        // format is as follows:
        // firstname;lastname;grade
        // example: Joakim;Slim;5
        if (!isset($_POST['grade'])) {
            $_POST['grade'] = 0;
        }

        $book_author = $_POST['firstName'] . ";" . $_POST['lastName'] . ";" . $_POST['grade'] . PHP_EOL;
        fwrite($database_file, $book_author);
        fclose($database_file);

        header('Location: index.php?cmd=author-list&message=saved');
    }
}


?>
<main>
    <?php if ($first_name_error && $last_name_error):?>
    <div id="error-block">
        Eesnimi peab olema 1 kuni 21 märki! <br>
        Perekonnanimi peab olema 2 kuni 22 märki!
    </div>
    <?php elseif($first_name_error):?>
        <div id="error-block">Eesnimi peab olema 1 kuni 21 märki!</div>
    <?php elseif ($last_name_error):?>
        <div id="error-block">Perekonnanimi peab olema 2 kuni 22 märki!</div>
    <?php endif;?>
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