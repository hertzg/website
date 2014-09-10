<?php

function create_contact_panel ($photoSrc, $info) {
    return
        '<div class="contactPanel">'
            .'<div class="photo">'
                ."<img src=\"$photoSrc\" />"
            .'</div>'
            .'<div class="info">'
                .$info
            .'</div>'
        .'</div>';
}
