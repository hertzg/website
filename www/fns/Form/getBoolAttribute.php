<?php

namespace Form;

function getBoolAttribute ($name, $options) {
    if (array_key_exists($name, $options) && $options[$name]) {
        return " $name=\"$name\"";
    }
}
