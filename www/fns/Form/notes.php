<?php

namespace Form;

function notes ($notes) {
    $ul = '<ul class="form-notes">';
    foreach ($notes as $note) {
        $ul .=
            '<li class="form-notes-item">'
                ."<span class=\"form-notes-item-bullet\"></span>$note"
            .'</li>';
    }
    $ul .= '</ul>';
    include_once __DIR__.'/association.php';
    return association($ul, '');
}
