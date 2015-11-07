<?php

namespace Form;

function button ($text, $name = null, $autofocus = false) {
    return '<input class="clickable form-button"'
        .($autofocus ? ' autofocus="autofocus"' : '')
        .($name === null ? '' : " name=\"$name\"")
        ." type=\"submit\" value=\"$text\" />";
}
