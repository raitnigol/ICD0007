<?php
// get cmd if set (logic for changing pages)

ob_start(); // makes the redirects work after form submit in pages
if (!isset($_GET['cmd'])) {
    $cmd = $_GET['cmd'] ?? 'book-list';
}
else {
    $cmd = $_GET['cmd'];
    $_GET['cmd'] = $cmd;
}

var_dump($_GET);

/*
// idk? this works to make redirect work after form submit in pages
ob_start();
var_dump($_POST);
var_dump($_GET);

$cmd = $_GET['cmd'] ?? 'book-list';
echo $cmd;
*/
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
        <div id="command-content">
            <?php if (isset($_GET['message']) && $_GET['message'] == 'saved'):?>
                <div id="message-block">Lisatud!</div>
            <?php endif;?>
            <?php
                // change pages based on cmd logic
                #echo "cmd: ". $cmd;
                $files_directory = "sub";
                $file_to_serve = $files_directory."/".$cmd.".php";
                if (file_exists($file_to_serve)) {
                    include($file_to_serve);
                }
                // if book form is submitted but has errors, go to same page
                if ($cmd == 'book-form-submit') {
                    echo "retard";
                    include('sub/book-form.php');
                }

                if ($cmd == 'author-save') {
                    echo "autori perses";
                    include('sub/author-form.php');
                }
                /*
                $cmd = $_GET['cmd'] ?? 'book-list';
                if (isset($_GET['cmd'])) {
                    $content = $_GET['cmd'];
                }
                else {
                    echo "Didnt find any content :/";
                    $content = 'book-list';
                }

                $page = "sub/".$content.".php";
                if (file_exists($page)) {
                    include($page);
                } elseif ($content = 'book-form-submit') {
                    include('sub/book-form.php');
                } elseif ($content = 'author-save') {
                    include('sub/author-form.php');
                }
                print "curr page " . var_dump($page);
                */
            ?>

        </div>
        <footer>ICD0007 Rakendus</footer>
    </div>
</body>
</html>
<!-- Replaces whitespace from ><, found from SOF. Apparently fixes the shitty star placement -->
<?= preg_replace("/>(\s+)</", '><', ob_get_clean()) ?>