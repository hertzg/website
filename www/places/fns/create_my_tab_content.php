<?php

function create_my_tab_content ($user) {
    $num_places = $user->num_places;
    if ($num_places) {
        include_once __DIR__.'/../../fns/title_and_description.php';
        return title_and_description('My', "$num_places total.");
    }
    return 'My';
}
