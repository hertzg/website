<?php

function create_prev_link ($files, $index, $parent_id) {

    if (!$index) return;

    $href = '?id='.$files[$index - 1]->id_files;
    if ($parent_id) $href .= "&amp;parent_id=$parent_id";

    return
        "<a class=\"clickable arrow left\" href=\"$href\">"
            .'<span class="icon arrow-left"></span>'
        .'</a>';

}
