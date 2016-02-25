<?php

include_once '../../../../lib/defaults.php';

trait expectType {
    function expectType ($variableName, $expectedType, $value) {
        $type = gettype($value);
        if ($type != $expectedType) {
            $this->error(
                "Expected response$variableName to be"
                ." of $expectedType type. Type $type received."
            );
        }
    }
}
