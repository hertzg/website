<?php

namespace Form;

function button ($text) {
    return '<input class="clickable form-button"'
        ." type=\"submit\" value=\"$text\" />";
}
