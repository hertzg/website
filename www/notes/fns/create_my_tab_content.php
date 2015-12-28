<?php

function create_my_tab_content ($user) {
    $num_notes = $user->num_notes;
    if ($num_notes) {
        include_once __DIR__.'/../../fns/title_and_description.php';
        return title_and_description('My', "$num_notes total.");
    }
    return 'My';
}
