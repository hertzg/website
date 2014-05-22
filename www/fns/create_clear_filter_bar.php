<?php

function create_clear_filter_bar ($tag, $clearHref) {
    return
        '<div class="filterBar">'
            .'Tag: <b>'.htmlspecialchars($tag).'</b>'
            .'<a class="clickable" title="Clear Filter"'
            ." href=\"$clearHref\">"
                .'<span class="icon no"></span>'
            .'</a>'
        .'</div>';
}
