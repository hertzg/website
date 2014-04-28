<?php

namespace Page;

function phpCode ($content) {
    return
        '<div class="page-text">'
            ."<pre class=\"php-code\">$content</pre>"
        .'</div>';
}
