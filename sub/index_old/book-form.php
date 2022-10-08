<?php
var_dump($_POST);
$book_error = false;

if (isset($_POST["title"])) {
    echo PHP_EOL . "Pealkiri: " . $_POST["title"];
    $book_title = $_POST["title"];
    if (strlen($book_title) < 3) {
        $book_error = true;
    }
    if (strlen($book_title) > 23) {
        $book_error = true;
    }
}

if (isset($_POST["author1"])) {
    echo "Autor 1: " . $_POST["author1"];
}

if (isset($_POST["author2"])) {
    echo "Autor 1: " . $_POST["author2"];
}

if (isset($_POST["grade"])) {
    echo "Hinne: " . $_POST["grade"];
}

if (isset($_POST[""])) {
    echo "Hinne: " . $_POST["grade"];
}

$query = 0;
#echo "On loetud: " . $_POST["isRead"];

$book_data = json_encode($_POST);
#echo var_dump($book_data);
file_put_contents('database.json', $book_data);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
}

?>

<main>
    <?php if(($book_error)):?>
        <div id="error-block">Pealkiri peab olema 3 kuni 23 tähemärki!</div><br>
    <?php endif;?>
    <form id="input-form" action="?cmd=book-form-submit" method="post">
        <input name="id" type="hidden" value="">
        <div class="label-cell">
            <label for="title">Pealkiri:</label>
        </div>
        <div class="input-cell">
            <input id="title" name="title" type="text" value="">
        </div>
        <div class="label-cell">
            <label for="author1">Autor 1:</label>
        </div>
        <div class="input-cell">
            <select id="author1" name="author1">
                <option value="0"></option>
                <option value="1">testautor1</option>
            </select>
        </div>

        <div class="label-cell">
            <label for="author2">Autor 2:</label>
        </div>
        <div class="input-cell">
            <select id="author2" name="author2">
                <option value="0"></option>
                <option value="1">testautor2</option>
            </select>
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
        <div class="label-cell">
            <label for="read">Loetud:</label>
        </div>
        <div class="input-cell">
            <input id="read" name="isRead" type="checkbox"/>
        </div>
        <div class="flex-break"></div>
        <div class="label-cell"></div>
        <div class="input-cell button-cell">
            <input name="submitButton" type="submit" value="Salvesta">
        </div>
    </form>
</main>
