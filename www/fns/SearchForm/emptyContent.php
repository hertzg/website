<?php

namespace SearchForm;

function emptyContent ($placeholder) {
    return
        '<span class="search_form-content empty">'
            .'<input class="form-textfield" type="text" name="keyword"'
            ." required=\"required\" placeholder=\"$placeholder\" />"
        .'</span>'
        .'<button title="Search"'
        .' class="search_form-button rightButton clickable">'
            .'<span class="rightButton-icon icon search"></span>'
            .'<span class="displayNone">Search</span>'
        .'</button>';
}
