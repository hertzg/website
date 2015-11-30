<?php

namespace Users\Calculations;

function searchPage ($mysqli, $user, $keyword, $offset, $limit, &$total) {

    if (!$user->num_calculations) return [];

    include_once __DIR__.'/../../Calculations/searchPage.php';
    return \Calculations\searchPage($mysqli, $user->id_users,
        $keyword, $offset, $limit, $total, $user->calculations_order_by);

}
