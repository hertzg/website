<?php

namespace Form;

function checkbox ($base, $name, $text, $checked) {
    return
        '<div class="form-checkbox transformable">'
            .'<label>'
                .'<div class="clickable">'
                    .'<div class="hidden">'
                        ."<input type=\"checkbox\" id=\"$name\" name=\"$name\""
                        .($checked ? ' checked="checked"' : '').' />'
                    .'</div>'
                .'</div>'
                .$text
            .'</label>'
        .'</div>'
        .'<script type="text/javascript" async="async"'
        ." src=\"{$base}js/transform-form-checkboxes.js\">"
        .'</script>';
}
