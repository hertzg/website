<?php

namespace SearchForm;

function emptyContent ($placeholder) {
    return
        '<div style="position: absolute; top: 0; right: 48px; bottom: 0; left: 0">'
            .'<input class="form-textfield" type="text" name="keyword"'
            ." placeholder=\"$placeholder\" />"
        .'</div>'
        .'<button class="searchButton clickable" title="Search">'
            .'<span class="icon search"></span>'
        .'</button>';
}
