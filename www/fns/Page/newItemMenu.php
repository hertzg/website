<?php

namespace Page;

function newItemMenu ($content) {
    return
        '<div class="newItemMenu">'
            .'<div class="newItemMenu-icon">'
                .'<div class="background horizontal"></div>'
                .'<div class="background vertical"></div>'
                .'<div class="foreground horizontal"></div>'
                .'<div class="foreground vertical"></div>'
            .'</div>'
            .'<div class="newItemMenu-text">New</div>'
            .'<div class="newItemMenu-menu">'
                .'<div class="newItemMenu-arrow"></div>'
                .'<div class="newItemMenu-frame">'
                    .'<div class="newItemMenu-frameContent">'
                        .$content
                    .'</div>'
                .'</div>'
            .'</div>'
        .'</div>';
}
