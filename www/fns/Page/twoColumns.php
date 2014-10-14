<?php

namespace Page;

function twoColumns ($column1, $column2) {
    return
        '<div class="twoColumns">'
            ."<div class=\"twoColumns-column1 dynamic\">$column1</div>"
            ."<div class=\"twoColumns-column2 dynamic\">$column2</div>"
        .'</div>';
}
