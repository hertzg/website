<?php

namespace Form;

function checkboxItem ($name, $text, $checked) {
    return
        '<div class="form-checkbox item transformable">'
            .'<label class="form-checkbox-label clickable">'
                .'<span class="form-checkbox-inputWrapper">'
                    .'<input class="form-checkbox-input"'
                    ." type=\"checkbox\" id=\"$name\" name=\"$name\""
                    .($checked ? ' checked="checked"' : '').' />'
                .'</span>'
                .$text
            .'</label>'
        .'</div>';
}
