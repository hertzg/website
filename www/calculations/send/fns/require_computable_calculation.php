<?php

function require_computable_calculation ($mysqli, $base = '') {

    include_once __DIR__.'/../../fns/require_calculation.php';
    list($calculation, $id, $user) = require_calculation($mysqli, $base);

    if ($calculation->value === null) {
        unset($_SESSION['calculations/view/messages']);
        $_SESSION['calculations/view/errors'] = [
            'The calculation is no longer computable.',
        ];
        include_once __DIR__.'/../../../fns/redirect.php';
        include_once __DIR__.'/../../../fns/ItemList/itemQuery.php';
        redirect("$base../view/".ItemList\itemQuery($id));
    }

    return [$calculation, $id, $user];

}
