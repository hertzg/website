<?php

function create_next_link ($files, $index, $parent_id_folders) {

    if ($index >= count($files) - 1) return;

    $href = '?id='.$files[$index + 1]->id_files;
    if ($parent_id_folders) {
        $href .= "&amp;parent_id_folders=$parent_id_folders";
    }

    return
        "<a class=\"clickable arrow right\" href=\"$href\">"
            .'<span class="icon arrow-right"></span>'
        .'</a>';

}
