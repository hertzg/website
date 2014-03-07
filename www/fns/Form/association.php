<?php

namespace Form;

function association ($value, $property) {
    return
        '<div class="form-item">'
            ."<div class=\"form-property\">$property</div>"
            ."<div class=\"form-value\">$value</div>"
        .'</div>';
}
