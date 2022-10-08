<?php
var_dump($_POST);
$book_error = false;

if (isset($_GET['cmd'])) {
    $cmd = $_GET['cmd'];
    #echo $cmd;

    if ($cmd === 'book-list') {
        include_once('index.php');
        echo "We are on book list page";
    } elseif ($cmd === 'book-form') {
        include_once('book-form.php');
        echo "We are on book form page";
    } elseif ($cmd === 'author-list') {
        include_once('author-list.php');
        echo "We are on author list page";
    } elseif ($cmd === 'author-form') {
        include_once('author-form.php');
        echo "We are on author form page";
    }
} else {
    $cmd = 'author-list';
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

        </main>
        <footer>ICD0007 Rakendus</footer>
    </div>
</body>
</html>