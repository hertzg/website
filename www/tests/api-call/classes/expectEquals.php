<?php

include_once '../../../../lib/defaults.php';

trait expectEquals {
    function expectEquals ($variableName1, $variableName2, $value1, $value2) {
        if ($value1 !== $value2) {
            $this->error(
                "response$variableName1 should have been"
                ." equal to response$variableName2."
            );
        }
    }
}
