<?php

function create_my_tab_content ($user) {
    $num_tasks = $user->num_tasks;
    if ($num_tasks) {
        include_once __DIR__.'/../../fns/title_and_description.php';
        return title_and_description('My', "$num_tasks total.");
    }
    return 'My';
}
