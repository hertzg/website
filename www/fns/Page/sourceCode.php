<?php

namespace Page;

function sourceCode ($content) {
    return
        '<div class="page-text">'
            ."<pre class=\"source_code\">$content</pre>"
        .'</div>';
}
