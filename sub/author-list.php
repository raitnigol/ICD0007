<main>
    <div id="list-table">
        <div class="title-cell header-cell">Eesnimi</div>
        <div class="author-cell header-cell">Perekonnanimi</div>
        <div class="grade-cell header-cell score-column">Hinne</div>
        <div class="flex-break header-divider"></div>
        <?php
        $authors = array();
        foreach(file('database/authors_data.txt') as $line) {
            $author_data = explode(";", $line);
            $author_name = $author_data[0];
            $author_last_name = $author_data[1];
            $author_grade = trim($author_data[2]);

            $author = array($author_name, $author_last_name, $author_grade);
            $authors[] = $author;
        }
        ?>
        <?php foreach($authors as $author): ?>
            <div class="header-cell"><a href="?cmd=author-form"><?= $author[0]; ?></a></div>
            <div class="header-cell"><a href="?cmd=author-form"><?= $author[1]; ?></a></div>

        <div class="score-empty score-column">
            <?php if(!$author[2] == "0"): ?>
                <?php foreach(range(1, $author[2]) as $i): ?>
                    <span class="score-filled">&starf;</span>
                <?php endforeach; ?>
                <?php if(!($author[2] == "5")): ?>
                    <?php foreach(range(1, 5 - $author[2]) as $i): ?>
                        <span>&starf;</span>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php if($author[2] == "0"): ?>
                <?php foreach(range(1, 5) as $i): ?>
                    <span>&starf;</span>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="flex-break"></div>
        <?php endforeach; ?>
</main>