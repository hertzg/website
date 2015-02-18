<?php

function title_and_description ($title, $description) {
    return
        '<div class="title_and_description">'
            ."<div class=\"title_and_description-title\">$title</div>"
            .'<div class="title_and_description-description">'
                .$description
            .'</div>'
        .'</div>';
}
