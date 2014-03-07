<?php

namespace Form;

function hidden ($name, $value) {
    $value = htmlspecialchars($value);
    return "<input type=\"hidden\" name=\"$name\" value=\"$value\" />";
}
