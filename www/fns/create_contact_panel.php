<?php

function create_contact_panel ($photoSrc, $info) {
    return
        '<div class="contactPanel">'
            .'<div class="contactPanel-photo">'
                ."<img class=\"contactPanel-image\" src=\"$photoSrc\" />"
            .'</div>'
            ."<div class=\"contactPanel-info\">$info</div>"
        .'</div>';
}
