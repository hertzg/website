<?php

namespace Page;

function newItemMenu ($content) {
    return
        '<div class="newItemMenu">'
            .'<button class="newItemMenu-button">'
                .'<span class="newItemMenu-icon">'
                    .'<span class="newItemMenu-icon-line horizontal"></span>'
                    .'<span class="newItemMenu-icon-line vertical"></span>'
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
