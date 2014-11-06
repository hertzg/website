<?php

function create_assert ($ok, $text) {
    return
        '<li'.($ok ? '' : ' class="error"').'>'
            .'<code>'.($ok ? '&#x2713;' : '&bull;').'</code>'
            ." $text"
        .'</li>';
}
