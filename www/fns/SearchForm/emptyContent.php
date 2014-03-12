<?php

namespace SearchForm;

function emptyContent ($placeholder) {
    return
        '<div class="search_form-content empty">'
            .'<input class="form-textfield" type="text" name="keyword"'
            ." placeholder=\"$placeholder\" />"
        .'</div>'
        .'<button class="searchButton clickable" title="Search">'
            .'<span class="icon search"></span>'
        .'</button>';
}
