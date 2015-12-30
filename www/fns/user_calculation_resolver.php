<?php

function user_calculation_resolver ($mysqli, $user, &$depends, $exclude_id) {

    $calculations = [];
    $depends = [];

    include_once __DIR__.'/CalculationDepends/indexOnCalculation.php';
    include_once __DIR__.'/Users/Calculations/get.php';
    return function ($id) use ($mysqli, $user,
        $exclude_id, &$calculations, &$depends) {

        if ($exclude_id !== null) {

            if ($id == $exclude_id) return;

            $queue = [$id];
            while ($queue) {
                $next_id = array_shift($queue);
                $this_depends = CalculationDepends\indexOnCalculation(
                    $mysqli, $next_id);
                foreach ($this_depends as $depend) {
                    $depend_id_calculations = $depend->depend_id_calculations;
                    if ($depend_id_calculations == $exclude_id) return;
                    $queue[] = $depend_id_calculations;
                }
            }

        }

        if (!array_key_exists($id, $calculations)) {
            $calculation = Users\Calculations\get($mysqli, $user, $id);
            if (!$calculation) return;
            $calculations[$id] = $calculation;
            $depends[] = $id;
        }

        return $calculations[$id]->value;

    };

}
