<?php

namespace Form;

function button ($text, $name = null, $autofocus = false) {
    $class = $name === null ? 'green' : 'not_green';
    return
        "<div class=\"form-button $class\">"
            ."<input class=\"form-button-button $class\""
            .($autofocus ? ' autofocus="autofocus"' : '')
            .($name === null ? '' : " name=\"$name\"")
            ." type=\"submit\" value=\"$text\" />"
        .'</div>';
}
