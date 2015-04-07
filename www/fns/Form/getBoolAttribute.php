<?php

namespace Form;

function getBoolAttribute ($name, $config) {
    if (array_key_exists($name, $config) && $config[$name]) {
        return " $name=\"$name\"";
    }
}
