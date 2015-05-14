<?php

namespace Page;

function newItemMenu ($content) {
    return
        '<div class="newItemMenu">'
            .'<button class="newItemMenu-button">'
                .'<span class="newItemMenu-icon">'
                    .'<span class="background horizontal"></span>'
                    .'<span class="background vertical"></span>'
                    .'<span class="foreground horizontal"></span>'
                    .'<span class="foreground vertical"></span>'
                .'</span>'
                .'<span class="newItemMenu-text">New</span>'
            .'</button>'
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
