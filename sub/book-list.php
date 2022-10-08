<?php

// get all books
$books = array();
foreach(file('database/books_data.txt') as $line) {
    $book_data = explode(";", $line);
    #var_dump($book_data);
    $book_id = $book_data[0];
    $book_title = $book_data[1];
    $book_author1 = $book_data[2];
    $book_author2 = $book_data[3];
    $book_grade = trim($book_data[4]);
    $book_is_read = $book_data[5];

    $book = array("book_title" => $book_title, "book_author1" => $book_author1, "book_author2" => $book_author2, "book_grade" => $book_grade, "book_is_read" => $book_is_read, "book_id" => $book_id);
    $books[] = $book_data;
}

// get all authors
$authors = array();
foreach(file('database/authors_data.txt') as $line) {
    $author_data = explode(";", $line);
    $author_id = trim($author_data[0]);
    $author_name = trim($author_data[1]);
    $author_last_name = trim($author_data[2]);
    $author_grade = trim($author_data[3]);


    $author = array("author_name" => $author_name, "author_last_name" => $author_last_name, "author_grade" => $author_grade, "author_id" => $author_id);
    $authors[] = $author;
}

?>
<main>
    <div id="list-table">
        <div class="title-cell header-cell">Pealkiri</div>
        <div class="author-cell header-cell">Autorid</div>
        <div class="grade-cell header-cell score-column">Hinne</div>
        <div class="flex-break header-divider"></div>

        <?php foreach($books as $book): ?>
            <div class="header-cell"><a href="?cmd=book-form&id=<?= $book[0]; ?>"><?= $book[1]; ?></a></div>
            <div><?= $book[2] . ", " . $book[3]; ?></div>
            <div class="score-empty score-column">
                <?php if(!$book[4] == "0"): ?>
                    <?php foreach(range(1, $book[4]) as $i): ?>
                        <span class="score-filled">&starf;</span>
                    <?php endforeach; ?>
                    <?php if(!($book[4] == "5")): ?>
                        <?php foreach(range(1, 5 - $book[4]) as $i): ?>
                            <span>&starf;</span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if($book[4] == "0"): ?>
                <?php foreach(range(1, 5) as $i): ?>
                    <span>&starf;</span>
                <?php endforeach; ?>
                <?php endif; ?>

            </div>
            <div class="flex-break"></div>
        <?php endforeach; ?>
</main>
