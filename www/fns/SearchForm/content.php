<?php

namespace SearchForm;

function content ($keyword, $placeholder, $clearHref) {
    return
        '<span class="search_form-content">'
            .'<input class="form-textfield" type="text" name="keyword"'
            .' autofocus="autofocus" value="'.htmlspecialchars($keyword).'"'
            ." placeholder=\"$placeholder\" />"
        .'</span>'
        .'<button title="Search"'
        .' class="search_form-button withClearButton rightButton clickable">'
            .'<span class="rightButton-icon icon search"></span>'
            .'<span class="displayNone">Search</span>'
        .'</button>'
        .'<span class="zeroSize"> </span>'
        ."<a href=\"$clearHref\" title=\"Clear Search Keyword\""
        .' class="rightButton clickable">'
            .'<span class="rightButton-icon icon no"></span>'
            .'<span class="displayNone">Cancel Search</span>'
        .'</a>';
}
