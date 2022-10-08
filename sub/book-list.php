<main>
    <div id="list-table">
        <div class="title-cell header-cell">Pealkiri</div>
        <div class="author-cell header-cell">Autorid</div>
        <div class="grade-cell header-cell score-column">Hinne</div>
        <div class="flex-break header-divider"></div>
        <?php
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
            #echo "Raamat - " . $book_title . " Autoritega " . $book_author1 . " Ja " . $book_author2 . " Hindega " . $book_grade . " Loetud/ei: " . $book_is_read;
        /*
        $book_grade_stars = null;

        foreach(range(1, $book_grade) as $i) {
            #echo "<span class='score-filled'>&starf;</span>";
            $book_grade_stars.= "<span class='score-filled'>&starf;</span>";
        }
        if (!($book_grade == "5")) {
            foreach(range(1, 5 - $book_grade) as $i) {
                #echo "<span>&starf;</span>";
                $book_grade_stars.= "<span>&starf;</span>";
            }
        }
        #echo $book_grade_stars;
        */
        $book = array($book_title, $book_author1, $book_author2, $book_grade, $book_is_read, $book_id);
        $books[] = $book_data;
    }
    /* <div id="<?= $book_title; ?> */
        ?>
        <?php foreach($books as $book): ?>
            <div class="header-cell"><a href="?cmd=book-form&id=<?= $book[5]; ?>"><?= $book[0]; ?></a></div>
            <div><?= $book[1] . ", " . $book[2]; ?></div>
            <div class="score-empty score-column">
                <?php if(!$book[3] == "0"): ?>
                    <?php foreach(range(1, $book[3]) as $i): ?>
                        <span class="score-filled">&starf;</span>
                    <?php endforeach; ?>
                    <?php if(!($book[3] == "5")): ?>
                        <?php foreach(range(1, 5 - $book[3]) as $i): ?>
                            <span>&starf;</span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if($book[3] == "0"): ?>
                <?php foreach(range(1, 5) as $i): ?>
                    <span>&starf;</span>
                <?php endforeach; ?>
                <?php endif; ?>

            </div>
            <div class="flex-break"></div>
        <?php endforeach; ?>
</main>
