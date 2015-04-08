<?php

namespace SearchForm;

function create ($action, $content) {
    return
        "<form action=\"$action\" class=\"search_form\">$content</form>"
        .'<br class="zeroHeight" />';
}
