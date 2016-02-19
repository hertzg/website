<?php

function create_contact_panel ($photoSrc, $info, $base, &$scripts) {

    include_once __DIR__.'/compressed_js_script.php';
    $scripts .= compressed_js_script('imageProgress', $base);

    return
        '<div class="contactPanel">'
            .'<div class="contactPanel-photo">'
                .'<div class="contactPanel-imageWrapper imageProgress">'
                    ."<img class=\"contactPanel-image\" src=\"$photoSrc\" />"
                .'</div>'
            .'</div>'
            ."<div class=\"contactPanel-info\">$info</div>"
        .'</div>';;

}
