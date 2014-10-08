<?php

namespace SearchForm;

function emptyContent ($placeholder) {
    return
        '<div class="search_form-content empty">'
            .'<input class="form-textfield" type="text" name="keyword"'
            ." required=\"required\" placeholder=\"$placeholder\" />"
        .'</div>'
        .'<button class="search_form-button rightButton clickable" title="Search">'
            .'<span class="icon search"></span>'
        .'</button>';
}
