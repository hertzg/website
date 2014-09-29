<?php

function create_prev_link ($files, $index, $parent_id_folders) {

    if (!$index) return;

    $href = '?id='.$files[$index - 1]->id_files;
    if ($parent_id_folders) {
        $href .= "&amp;parent_id_folders=$parent_id_folders";
    }

    return
        "<a class=\"clickable arrow left\" href=\"$href\">"
            .'<span class="icon arrow-left"></span>'
        .'</a>';

}
