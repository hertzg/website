<?php

include_once '../../../../lib/defaults.php';

include_once 'fns/require_first_stage.php';
list($user, $first_stage) = require_first_stage();

$fnsDir = '../../../fns';

include_once '../../fns/create_offset_select.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/ItemList/escapedPageQuery.php";
include_once "$fnsDir/ItemList/listHref.php";
include_once "$fnsDir/ItemList/pageHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/imageLink.php";
include_once "$fnsDir/Page/staticTwoColumns.php";
$content = Page\create(
    [
        'title' => 'Schedules',
        'href' => '../'.ItemList\listHref(),
    ],
    'New Schedule',
    Page\imageLink('Back', '../'.ItemList\escapedPageQuery(), 'arrow-left')
    .'<div class="hr"></div>'
    .'<form action="submit.php" method="post">'
        .create_offset_select($user, $first_stage['interval'], 0)
        .Page\staticTwoColumns(
            Form\button('Save'),
            Form\button('Send', 'sendButton')
        )
        .ItemList\pageHiddenInputs()
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'New Schedule', $content, '../../../');
