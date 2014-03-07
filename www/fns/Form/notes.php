<?php

namespace Form;

function notes (array $notes) {
    $ul = '<ul class="form-notes">';
    foreach ($notes as $note) {
        $ul .= "<li>$note</li>";
    }
    $ul .= '</ul>';
    include_once __DIR__.'/association.php';
    return association($ul, '');
}
