<?php

namespace Form;

function getBoolAttribute ($name, array $config) {
    if (array_key_exists($name, $config) && $config[$name]) {
        return " $name=\"$name\"";
    }
}
