<?php

namespace SendForm;

function removeRecipientPage ($user, $id, $username, $title) {

    include_once __DIR__.'/../ItemList/escapedItemQuery.php';
    $escapedItemQuery = \ItemList\escapedItemQuery($id);

    include_once __DIR__.'/../ItemList/itemParams.php';
    $itemParams = \ItemList\itemParams($id);
    $itemParams['username'] = $username;
    $yesHref = 'submit.php?'.htmlspecialchars(http_build_query($itemParams));

    include_once __DIR__.'/../ItemList/listHref.php';
    include_once __DIR__.'/../Page/imageLink.php';
    include_once __DIR__.'/../Page/tabs.php';
    include_once __DIR__.'/../Page/text.php';
    include_once __DIR__.'/../Page/twoColumns.php';
    $content = \Page\tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../'.\ItemList\listHref(),
            ],
            [
                'title' => $title,
                'href' => "../../view/$escapedItemQuery",
            ],
        ],
        'Send',
        \Page\text('Are you sure you want to remove the recipient'
            .' "<b>'.htmlspecialchars($username).'</b>"?')
        .'<div class="hr"></div>'
        .\Page\twoColumns(
            \Page\imageLink('Yes, remove recipient', $yesHref, 'yes'),
            \Page\imageLink('No, return back', "../$escapedItemQuery", 'no')
        )
    );

    include_once __DIR__.'/../echo_page.php';
    echo_page($user, 'Remove Recipient?', $content, '../../../');

}
