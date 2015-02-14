<?php

function create_contact_panel ($photoSrc, $info, $base) {
    include_once __DIR__.'/compressed_js_script.php';
    return
        '<div class="contactPanel">'
            .'<div class="contactPanel-photo">'
                .'<div class="contactPanel-imageWrapper imageProgress">'
                    ."<img class=\"contactPanel-image\" src=\"$photoSrc\" />"
                .'</div>'
            .'</div>'
            ."<div class=\"contactPanel-info\">$info</div>"
        .'</div>'
        .compressed_js_script('imageProgress', $base);
}
