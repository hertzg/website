<?php

function user_calculation_resolver ($mysqli, $user, $exclude_id = null) {

    $calculations = [];

    include_once __DIR__.'/Users/Calculations/get.php';
    return function ($id) use ($mysqli, $user, $exclude_id, &$calculations) {

        if ($exclude_id !== null) {
            if ($id == $exclude_id) return;
        }

        if (!array_key_exists($id, $calculations)) {
            $calculation = Users\Calculations\get($mysqli, $user, $id);
            if (!$calculation) return;
        }

        $calculations[$id] = $calculation;
        return $calculation->value;

    };

}
