<?php

function title_and_description ($title, $description, $addClass = '') {
    return
        '<span class="title_and_description">'
            ."<span class=\"title_and_description-title$addClass\">"
                .$title
            .'</span>'
            .'<br class="zeroHeight" />'
            ."<span class=\"title_and_description-description$addClass\">"
                .$description
            .'</span>'
        .'</span>';
}
