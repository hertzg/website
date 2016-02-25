<?php

include_once '../../../../lib/defaults.php';

trait expectObject {
    function expectObject ($variableName, $properties, $object) {
        $this->expectType($variableName, 'object', $object);
        foreach ($properties as $property) {
            if (!property_exists($object, $property)) {
                $this->error(
                    "Required property $property"
                    ." not present in response$variableName."
                );
            }
        }
        foreach ($object as $property => $value) {
            if (!in_array($property, $properties)) {
                $this->error(
                    "Extra property $property"
                    ." was received in response$variableName."
                );
            }
        }
    }
}
