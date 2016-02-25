<?php

include_once '../../../../lib/defaults.php';

trait expectValue {
    function expectValue ($variableName, $expectedValue, $value) {
        if ($value !== $expectedValue) {
            $expectedValue = json_encode($expectedValue);
            $value = json_encode($value);
            $this->error(
                "Expected response$variableName to be $expectedValue."
                ." $value received."
            );
        }
    }
}
