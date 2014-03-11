<?php

namespace SearchForm;

function content ($keyword, $placeholder, $clearHref) {
    return
        '<div style="position: absolute; top: 0; right: 96px; bottom: 0; left: 0">'
            .'<input class="form-textfield searchIKeywordInput" type="text" name="keyword"'
            .' value="'.htmlspecialchars($keyword).'"'
            ." placeholder=\"$placeholder\" />"
        .'</div>'
        .'<button class="searchButton withClearButton clickable" title="Search">'
            .'<span class="icon search"></span>'
        .'</button>'
        ."<a href=\"$clearHref\" title=\"Clear Search Keyword\""
        .' class="clearSearchKeywordButton clickable">'
            .'<span class="icon no"></span>'
        .'</a>';
}
