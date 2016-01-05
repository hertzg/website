<?php

namespace Users\Calculations;

function updateDepends ($mysqli, $user, $id) {

    $fnsDir = __DIR__.'/../..';

    $queue = [$id];

    include_once "$fnsDir/evaluate.php";
    include_once "$fnsDir/user_calculation_resolver.php";
    include_once "$fnsDir/Calculations/get.php";
    while ($queue) {

        $id = array_shift($queue);

        include_once "$fnsDir/CalculationDepends/indexOnDependCalculation.php";
        $depends = \CalculationDepends\indexOnDependCalculation($mysqli, $id);

        foreach ($depends as $depend) {

            $queue[] = $depend->id_calculations;

            include_once "$fnsDir/Calculations/get.php";
            $calculation = \Calculations\get($mysqli, $depend->id_calculations);

            $value_of = user_calculation_resolver($mysqli,
                $user, $this_depends, $calculation->id);

            $value = evaluate($calculation->expression, $error, $error_char,
                $pretty_expression, $resolved_expression, $value_of);

            if ($value === false) $value = null;
            else $expression = $pretty_expression;

            if ($value === null) {
                $value = 'null';
                $error = "'".$mysqli->real_escape_string($error)."'";
            } else {
                $error = $error_char = 'null';
            }
            $resolved_expression = $mysqli->real_escape_string(
                $resolved_expression);

            $sql = "update calculations set value = $value,"
                ." error = $error, error_char = $error_char,"
                ." resolved_expression = '$resolved_expression'"
                ." where id = $calculation->id";

            $mysqli->query($sql) || trigger_error($mysqli->error);

            if ($calculation->num_tags) {
                $sql = "update calculation_tags set value = $value"
                    ." where id_calculations = $calculation->id";
                $mysqli->query($sql) || trigger_error($mysqli->error);
            }

        }
    }

}
