<?php

function create_search_form_empty_content () {
    return
        '<div style="position: absolute; top: 0; right: 48px; bottom: 0; left: 0">'
            .'<input class="form-textfield" type="text" name="keyword"'
            .' placeholder="Search tasks..."'
            .' style="width: 100%; height: 100%; cursor: text" />'
        .'</div>'
        .'<button class="clickable" title="Search"'
        .' style="position: absolute; top: 0; right: 0; bottom: 0; width: 48px; text-align: center">'
            .'<span class="icon search"></span>'
        .'</button>';
}
