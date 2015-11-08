<?php

function create_next_link ($files, $index, $parent_id) {

    if ($index >= count($files) - 1) return;

    $href = '?id='.$files[$index + 1]->id_files;
    if ($parent_id) $href .= "&amp;parent_id=$parent_id";

    return
        "<a class=\"clickable navigation-arrow right\" href=\"$href\">"
            .'<span class="navigation-arrow-icon icon arrow-right"></span>'
        .'</a>';

}
