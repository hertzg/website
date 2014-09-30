<?php

include_once 'fns/require_first_stage.php';
list($user, $first_stage) = require_first_stage();

include_once '../../fns/create_offset_select.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/ItemList/escapedPageQuery.php';
include_once '../../../fns/ItemList/listHref.php';
include_once '../../../fns/ItemList/pageHiddenInputs.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Schedules',
            'href' => '../'.ItemList\listHref(),
        ],
    ],
    'New',
    Page\imageLink('Back', '../'.ItemList\escapedPageQuery(), 'arrow-left')
    .'<div class="hr"></div>'
    .'<form action="submit.php" method="post">'
        .create_offset_select($user, $first_stage['interval'], 0)
        .'<div class="hr"></div>'
        .Form\button('Save Schedule')
        .ItemList\pageHiddenInputs()
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'New Schedule', $content, '../../../');
