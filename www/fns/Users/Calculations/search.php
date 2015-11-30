<?php

namespace Users\Calculations;

function search ($mysqli, $user, $keyword) {

    if (!$user->num_calculations) return [];

    include_once __DIR__.'/../../Calculations/search.php';
    return \Calculations\search($mysqli, $user->id_users, $keyword);

}
