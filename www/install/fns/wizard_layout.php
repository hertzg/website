<?php

function wizard_layout ($left, $center, $bottom) {
    return
        '<div class="wizard">'
            ."<div class=\"wizard-left\">$left</div>"
            ."<div class=\"wizard-center\">$center</div>"
            ."<div class=\"wizard-bottom\">$bottom</div>"
        .'</div>';
}
