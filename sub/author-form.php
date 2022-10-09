<?php

#var_dump($_GET);
#var_dump($_POST);
// set first & last name errors to false by default
$first_name_error = false;
$last_name_error = false;

// generate id + get last id
$author_ids = array();
foreach(file('database/authors_data.txt') as $line) {
    $author_data = explode(";", $line);
    $author_id = $author_data[0];
    $author_ids[] = $author_id;
}

$max_id = intval(max($author_ids));
$new_author_id = strval($max_id + 1);

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

// get authors to edit allow editing
$authors = array();

foreach(file('database/authors_data.txt') as $line) {
    $author_data = explode(";", $line);
    $author_id = $author_data[0];
    $author_name = $author_data[1];
    $author_last_name = $author_data[2];
    $author_grade = trim($author_data[3]);

    $author = array("author_id" => $author_id, "author_first_name" => $author_name, "author_last_name" => $author_last_name, "author_grade" => $author_grade);
    $authors[] = $author;
}

if (!$first_name_error && !$last_name_error) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // clear file if id defined
        $database_file = fopen('database/authors_data.txt', 'a');


        // write to file logic (append to fake database file)
        // -> create the appendable data
        // format is as follows:
        // firstname;lastname;grade
        // example: Joakim;Slim;5

        if (!isset($_POST['grade'])) {
            $_POST['grade'] = 0;
        }

        if (isset($_POST['id']) && $_POST['id'] != '') {
            $lines = file('database/authors_data.txt');
            $result = '';

            foreach($lines as $line) {
                if(substr($line, 0, 1) == $_POST['id']) {
                    $result .= $_POST['id'] . ";" . $_POST['firstName'] . ";" . $_POST['lastName'] . ";" . $_POST['grade'] . PHP_EOL;
                } else {
                    $result .= $line;
                }
            }
            file_put_contents('database/authors_data.txt', $result);
        }
        else {
            $book_author = $new_author_id . ";" . $_POST['firstName'] . ";" . $_POST['lastName'] . ";" . $_POST['grade'] . PHP_EOL;
            fwrite($database_file, $book_author);
        }

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
    <?php if (!isset($_GET['id'])): ?>
    <form id="input-form" method="post">
        <input name="id" type="hidden" value="">

        <div class="label-cell">
            <label for="name">Eesnimi:</label>
        </div>
        <div class="input-cell">
            <input id="name" name="firstName" value="" type="text">
        </div>

        <div class="label-cell">
            <label for="last-name">Perekonnanimi:</label>
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
    <?php endif; ?>
    <?php if (isset($_GET['id'])): ?>
        <form id="input-form" method="post">
            <input name="id" type="hidden" value="<?= $_GET['id'] ?? 0 ?>">

            <div class="label-cell">
                <label for="name">Eesnimi:</label>
            </div>
            <div class="input-cell">
                <?php foreach($authors as $author): ?>
                <?php if($author["author_id"] == $_GET['id']): ?>
                <input id="name" name="firstName" value="<?= $author["author_first_name"]; ?>" type="text">
            </div>
                <?php endif; ?>
                <?php endforeach; ?>

            <div class="label-cell">
                <label for="last-name">Perekonnanimi:</label>
            </div>
            <div class="input-cell">
                <?php foreach($authors as $author): ?>
                <?php if($author["author_id"] == $_GET['id']): ?>
                <input id="last-name" name="lastName" value="<?= $author["author_last_name"]; ?>" type="text">
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="label-cell">Hinne: </div>
            <div class="input-cell">
                <?php foreach(range(1, 5) as $i): ?>
                <?php foreach($authors as $author): ?>
                <?php if($author["author_id"] == $_GET['id']): ?>
                        <label>
                            <input type="radio" name="grade" value="<?= $i; ?>" <?php echo($author["author_grade"] == $i?'checked="checked"':''); ?>><?= $i; ?>
                        </label>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endforeach; ?>
            </div>

            <div class="flex-break"></div>

            <div class="label-cell"></div>
            <div class="input-cell button-cell">
                <input name="submitButton" type="submit" formaction="?cmd=author-save" value="Salvesta">
            </div>
        </form>
    <?php endif; ?>
</main>