<?php

function create_my_tab_content ($user) {
    $num_contacts = $user->num_contacts;
    if ($num_contacts) {
        include_once __DIR__.'/../../fns/title_and_description.php';
        return title_and_description('My', "$num_contacts total.");
    }
    return 'My';
}
