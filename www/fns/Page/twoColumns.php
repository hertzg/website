<?php

namespace Page;

function twoColumns ($column1, $column2) {
    return
        '<div class="twoColumns dynamic">'
            ."<div>$column1</div>"
            ."<div>$column2</div>"
        .'</div>';
}
