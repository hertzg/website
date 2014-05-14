<?php

namespace Form;

function button ($text, $name = '') {
    return '<input class="clickable form-button"'
        .($name === '' ? '' : " name=\"$name\"")
        ." type=\"submit\" value=\"$text\" />";
}
