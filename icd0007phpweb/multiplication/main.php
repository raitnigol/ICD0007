<?php

$header = file_get_contents('table-header.html');
$footer = file_get_contents('table-footer.html');

print $header;

foreach (range(0, 9) as $first) {
    print "<div>\n";
    foreach (range(0, 9) as $second) {
        $result = $first * $second;
        print "$first * $second = $result <br>\n";
    }
    print "</div>\n";
}

print  $footer;

