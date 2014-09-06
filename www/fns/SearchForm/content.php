<?php

namespace SearchForm;

function content ($keyword, $placeholder, $clearHref) {
    return
        '<div class="search_form-content">'
            .'<input class="form-textfield" type="text" name="keyword"'
            .' value="'.htmlspecialchars($keyword).'"'
            ." placeholder=\"$placeholder\" />"
        .'</div>'
        .'<button class="searchButton withClearButton clickable"'
        .' title="Search">'
            .'<span class="icon search"></span>'
        .'</button>'
        ."<a href=\"$clearHref\" title=\"Clear Search Keyword\""
        .' class="rightButton clickable">'
            .'<span class="icon no"></span>'
        .'</a>';
}
