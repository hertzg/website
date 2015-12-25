<?php

function create_new_item_button ($text, $base = '', $green = false) {

    include_once __DIR__.'/ItemList/escapedPageQuery.php';
    $href = "{$base}new/".ItemList\escapedPageQuery();

    include_once __DIR__.'/Page/newItemButton.php';
    return Page\newItemButton($href, $text, $green);

}
