<?php

include_once '../../../../lib/defaults.php';

trait expectGreater {
    function expectGreater ($variableName1, $variableName2, $value1, $value2) {
        if ($value1 <= $value2) {
            $this->error(
                "response$variableName1 should have been"
                ." greater than response$variableName2."
            );
        }
    }
}
