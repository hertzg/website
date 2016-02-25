<?php

include_once '../../../../lib/defaults.php';

trait expectNatural {
    function expectNatural ($variableName, $value) {
        $this->expectType($variableName, 'integer', $value);
        if ($value <= 0) {
            $this->error(
                "Expected response$variableName to be"
                ." a natural number. $value received."
            );
        }
    }
}
