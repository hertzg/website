<?php

function create_contact_panel ($photo, $info) {
    return
        '<div class="contactPanel">'
            .'<div class="photo"></div>'
            .'<div class="info">'
                .$info
            .'</div>'
        .'</div>';
}
