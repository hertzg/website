<?php

function create_clear_filter_bar ($tag, $clearHref) {
    if ($clearHref === '') $clearHref = './';
    return
        '<div class="filterBar">'
            .'Tag: <b>'.htmlspecialchars($tag).'</b>'
            .'<a class="rightButton clickable" title="Clear Filter"'
            ." href=\"$clearHref\">"
                .'<span class="rightButton-icon icon no"></span>'
            .'</a>'
        .'</div>';
}
