<?php

function create_clear_filter_bar ($tag, $clearHref) {
    return
        '<div style="position: relative; height: 48px; background: #eee; color: #444; padding: 16px">'
            .'Tag: <b>'.htmlspecialchars($tag).'</b>'
            ."<a class=\"clickable\" title=\"Clear Filter\" href=\"$clearHref\""
            .' style="position: absolute; top: 0; right: 0; bottom: 0; width: 48px">'
                .'<span class="icon no"'
                .' style="position: absolute; top: 0; right: 0; bottom: 0; left: 0; margin: auto">'
                .'</span>'
            .'</a>'
        .'</div>'
        .'<div class="warnings-hr"></div>';
}
