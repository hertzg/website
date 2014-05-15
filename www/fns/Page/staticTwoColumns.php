<?php

namespace Page;

function staticTwoColumns ($column1, $column2) {
    return
        '<div class="twoColumns">'
            ."<div>$column1</div>"
            ."<div>$column2</div>"
        .'</div>';
}
