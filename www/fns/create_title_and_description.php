<?php

function create_title_and_description ($title, $description) {
    return
        '<div class="title_and_description">'
            ."<div>$title</div>"
            ."<div>$description</div>"
        .'</div>';
}
