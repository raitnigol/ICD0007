<?php
// set book error to false by default
$book_error = false;

// generate id for the book + get all authors
$book_ids = array();

foreach(file('database/books_data.txt') as $line) {
    $book_data = explode(";", $line);
    $book_id = $book_data[5];
    $book_ids[] = $book_id;
}

// get the last id of books
$max_id = intval(max($book_ids));
$new_book_id = strval($max_id + 1);

// handle book length logic
if (isset($_POST["title"])) {
    $book_title = $_POST["title"];

    // handle book error
    if (strlen($book_title) < 3)
    {
        $book_error = true;
    }
    elseif (strlen($book_title) > 23) {
        $book_error = true;
    }
}

// get authors data to append to authors list
$authors = array();
foreach(file('database/authors_data.txt') as $line) {
    $author_data = explode(";", $line);
    $author_name = $author_data[0];
    $author_last_name = $author_data[1];
    $author_grade = trim($author_data[2]);
    $author_id = trim($author_data[3]);

    $author = array("author_name" => $author_name, "author_last_name" => $author_last_name, "author_grade" => $author_grade, "author_id" => $author_id);
    $authors[] = $author;
}

// get all books to match id
$books = array();
foreach(file('database/books_data.txt') as $line) {
    $book_data = explode(";", $line);
    #var_dump($book_data);
    $book_title = $book_data[0];
    $book_author1 = $book_data[1];
    $book_author2 = $book_data[2];
    $book_grade = trim($book_data[3]);
    $book_is_read = $book_data[4];
    $book_id = trim($book_data[5]);

    $book = array("book_title" => $book_title, "book_author1" => $book_author1, "book_author2" => $book_author2, "book_grade" => $book_grade, "book_is_read" => $book_is_read, "book_id" => $book_id);
    $books[] = $book_data;
}

// match book id to books
# TODO
# TODO
# TODO

// if book is not too long or too short, send POST request to index.php with the saved message
if (!$book_error) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // write to file logic (append to fake database file)
        $database_file = fopen('database/books_data.txt', 'a');
        // -> create the appendable data
        // format is as follows:
        // title;author1;author2;grade;isRead
        // example: Book Of Joakim;Joakim Slim;Joakim Fat;5;(on/ei)
        if (!isset($_POST['grade'])) {
            $_POST['grade'] = 0;
        }
        if (!isset($_POST['isRead'])) {
            $_POST['isRead'] = "no";
        } elseif (isset($_POST['isRead'])) {
            $_POST['isRead'] = "yes";
        }

        $book = $_POST['title'] . ";" . $_POST['author1'] . ";" . $_POST['author2'] . ";" . $_POST['grade'] . ";" . $_POST['isRead'] . ";" . $new_book_id . PHP_EOL;
        fwrite($database_file, $book);
        fclose($database_file);

        header('Location: index.php?cmd=book-list&message=saved');
    }
}

?>
<main>
    <?php if ($book_error):?>
        <div id="error-block">Pealkiri peab olema 3 kuni 23 tähemärki!</div><br>
    <?php endif;?>
    <form id="input-form" action="?cmd=book-form-submit" method="post">
        <input name="id" type="hidden" value="">
        <div class="label-cell">
            <label for="title">Pealkiri:</label>
        </div>
        <div class="input-cell">
            <input id="title" name="title" type="text" value="<?php if(isset($_POST['title'])) { echo htmlentities($_POST['title']); }?>">
        </div>
        <div class="label-cell">
            <label for="author1">Autor 1:</label>
        </div>
        <div class="input-cell">
            <select id="author1" name="author1">
                <option value="0"></option>
                <?php foreach($authors as $author): ?>
                <option value="<?=$author["author_id"]; ?>"><?= $author["author_name"] . " " . $author["author_last_name"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="label-cell">
            <label for="author2">Autor 2:</label>
        </div>
        <div class="input-cell">
            <select id="author2" name="author2">
                <option value="0"></option>
                <?php foreach($authors as $author): ?>
                    <option value="<?=$author["author_id"]; ?>"><?= $author["author_name"] . " " . $author["author_last_name"]; ?></option>
                <?php endforeach; ?>
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