<?php

namespace Users\Calculations;

function updateReferences ($mysqli, $id) {

/*
    $exclude_id = $id;
    $fnsDir = __DIR__.'/../..';

    $loaded_calculations = [];

    include_once "$fnsDir/Calculations/editValue.php";
    include_once "$fnsDir/Calculations/get.php";
    foreach ($referenced as $referenced_calculation) {

        $referenced_id_calculations = $referenced_calculation->id_calculations;

        $value_of = function ($id) use ($mysqli,
            $referenced_calculation, &$loaded_calculations) {

            if ($id == $referenced_calculation->id) return;

            $calculation = \Calculations\get($mysqli, $id);
            if (!$calculation) return;

            $loaded_calculations[$calculation->id] = $calculation;
            return $calculation->value;

        };

        include_once "$fnsDir/Calculations/get.php";
        $calculation = \Calculations\get($mysqli, $referenced_id_calculations);

        if (!$calculation) return;

        include_once "$fnsDir/evaluate.php";
        $value = evaluate($calculation->expression,
            $error, $error_char, $value_of);
        if ($value === false) $value = null;

        \Calculations\editValue($mysqli,
            $referenced_id_calculations, $value, $error, $error_char);

    }
*/

}
