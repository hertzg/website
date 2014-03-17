<?php

include_once 'fns/require_item.php';
list($item, $key, $user) = require_item();

$title = "Move Item";

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/text.php';
$content = create_tabs(
    array(
        array(
            'title' => '&middot;&middot;&middot;',
            'href' => '../../',
        ),
        array(
            'title' => 'Reorder Items',
            'href' => '../',
        ),
    ),
    $title,
    Page\text("Where would you like to move \"<b>$item[title]</b>\"?")
    .'<div class="hr"></div>'
    .Page\imageLink('To the Top', "submit-to-top.php?key=$key", 'move-top-top')
    .'<div class="hr"></div>'
    .Page\imageLink('Up', "submit-up.php?key=$key", 'move-up')
    .'<div class="hr"></div>'
    .Page\imageLink('Down', "submit-down.php?key=$key", 'move-down')
    .'<div class="hr"></div>'
    .Page\imageLink('To the Bottom',
        "submit-to-bottom.php?key=$key", 'move-top-bottom')
);

include_once '../../../fns/echo_page.php';
echo_page($user, $title, $content, '../../../');
