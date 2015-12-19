<?php

function render_folder ($folder, &$title, &$icon) {
    $title = htmlspecialchars($folder->name);
    $icon = 'folder';
}
