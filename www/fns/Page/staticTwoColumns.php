<?php

namespace Page;

function staticTwoColumns ($column1, $column2) {
    return
        '<div class="twoColumns">'
            ."<div class=\"twoColumns-column1\">$column1</div>"
            ."<div class=\"twoColumns-column2\">$column2</div>"
        .'</div>';
}
