<?php

function title_and_description ($title, $description) {
    return
        '<span class="title_and_description">'
            .'<span class="title_and_description-title">'
                .$title
            .'</span>'
            .'<br class="zeroHeight" />'
            .'<span class="title_and_description-description colorText grey">'
                .$description
            .'</span>'
        .'</span>';
}
