<?php
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

// handle editing the author
if (isset($_GET['id'])) {
    echo $_GET['id'];
}

?>
<main>
    <div id="list-table">
        <div class="title-cell header-cell">Eesnimi</div>
        <div class="author-cell header-cell">Perekonnanimi</div>
        <div class="grade-cell header-cell score-column">Hinne</div>
        <div class="flex-break header-divider"></div>
        <?php foreach($authors as $author): ?>
            <div class="header-cell"><a href="?cmd=author-form&id=<?= $author["author_id"] ?>"><?= $author["author_first_name"]; ?></a></div>
            <div class="header-cell"><?= $author["author_last_name"]; ?></div>

            <div class="score-empty score-column">
                <?php if(!$author["author_grade"] == "0"): ?>
                    <?php foreach(range(1, $author["author_grade"]) as $i): ?>
                        <span class="score-filled">&starf;</span>
                    <?php endforeach; ?>
                    <?php if(!($author["author_grade"] == "5")): ?>
                        <?php foreach(range(1, 5 - $author["author_grade"]) as $i): ?>
                            <span>&starf;</span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if($author["author_grade"] == "0"): ?>
                    <?php foreach(range(1, 5) as $i): ?>
                        <span>&starf;</span>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="flex-break"></div>
        <?php endforeach; ?>
</main>

<!--
        <?php foreach($authors as $author): ?>
            <div class="header-cell"><a href="?cmd=author-form&id=<?= $author["author_id"]; ?>"><?= $author["author_first_name"]; ?></a></div>
            <div class="header-cell"><?= $author["author_last_name"]; ?></a></div>
        <?php endforeach; ?>
        <div class="score-empty score-column">
            <?php foreach($authors as $author): ?>
            <?php if(!$author["author_grade"] == "0"): ?>
                <?php foreach(range(1, $author["author_grade"]) as $i): ?>
                    <span class="score-filled">&starf;</span>
                <?php endforeach; ?>
                <?php if(!($author["author_grade"] == "5")): ?>
                    <?php foreach(range(1, 5 - $author["author_grade"]) as $i): ?>
                        <span>&starf;</span>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php if($author["author_grade"] == "0"): ?>
                <?php foreach(range(1, 5) as $i): ?>
                    <span>&starf;</span>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="flex-break"></div>
        <?php endforeach; ?>
</main>
-->