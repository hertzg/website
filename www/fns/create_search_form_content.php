<?php

function create_search_form_content ($keyword, $placeholder) {
    return
        '<div style="position: absolute; top: 0; right: 96px; bottom: 0; left: 0">'
            .'<input class="form-textfield" type="text" name="keyword"'
            .' value="'.htmlspecialchars($keyword).'"'
            ." placeholder=\"$placeholder\""
            .' style="width: 100%; height: 100%; cursor: text" />'
        .'</div>'
        .'<button class="clickable" title="Search"'
        .' style="position: absolute; top: 0; right: 48px; bottom: 0; width: 48px; text-align: center">'
            .'<span class="icon search"></span>'
        .'</button>';
}
