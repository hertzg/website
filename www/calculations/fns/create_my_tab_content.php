<?php

function create_my_tab_content ($user) {
    $num_calculations = $user->num_calculations;
    if ($num_calculations) {
        include_once __DIR__.'/../../fns/title_and_description.php';
        return title_and_description('My', "$num_calculations total.");
    }
    return 'My';
}
