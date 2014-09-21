<?php

function compressed_css_link ($name, $base = '') {
    $fullName = "css/$name/compressed.css";
    include_once __DIR__.'/get_revision.php';
    $revision = get_revision($fullName);
    return '<link rel="stylesheet" type="text/css"'
        ." href=\"$base$fullName?$revision\" />";
}
