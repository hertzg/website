<?php

function create_filter_message ($tag) {
    return Page::warnings(array(
        'Showing tasks with <b>'.htmlspecialchars($tag).'</b> tag.<br />'
        .'<a class="a" href="index.php">Show all</a>',
    ));
}
