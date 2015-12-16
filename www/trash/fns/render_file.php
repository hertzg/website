<?php

function render_file ($file, &$title, &$icon) {
    $title = htmlspecialchars($file->name);
    $icon = "$file->media_type-file";
}
