<?php

function create_my_tab_content ($user) {
    $num_bookmarks = $user->num_bookmarks;
    if ($num_bookmarks) {
        include_once __DIR__.'/../../fns/title_and_description.php';
        return title_and_description('My', "$num_bookmarks total.");
    }
    return 'My';
}
