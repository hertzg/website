<?php

namespace Page;

function telLink ($number, $title) {
    include_once __DIR__.'/imageLink.php';
    return
        '<div class="telLink">'
            ."<div class=\"telLink-tel\">"
                .imageLink($title, "tel:$number", 'phone')
            .'</div>'
            ."<a class=\"rightButton clickable\" href=\"sms:$number\">"
                .'<span class="rightButton-icon icon sms"></span>'
            .'</a>'
        .'</div>';
}
