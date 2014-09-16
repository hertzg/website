<?php

namespace SendForm\NewItem;

function removeRecipientPage ($user, $username) {

    include_once __DIR__.'/../../ItemList/escapedPageQuery.php';
    $escapedPageQuery = \ItemList\escapedPageQuery();

    include_once __DIR__.'/../../ItemList/pageParams.php';
    $pageParams = \ItemList\pageParams();
    $pageParams['username'] = $username;
    $yesHref = 'submit.php?'.htmlspecialchars(http_build_query($pageParams));

    include_once __DIR__.'/../../Page/imageLink.php';
    include_once __DIR__.'/../../Page/tabs.php';
    include_once __DIR__.'/../../Page/text.php';
    include_once __DIR__.'/../../Page/twoColumns.php';
    $content = \Page\tabs(
        [
            [
                'title' => 'New',
                'href' => "../../$escapedPageQuery",
            ],
        ],
        'Send',
        \Page\text('Are you sure you want to remove the recipient'
            .' "<b>'.htmlspecialchars($username).'</b>"?')
        .'<div class="hr"></div>'
        .\Page\twoColumns(
            \Page\imageLink('Yes, remove recipient', $yesHref, 'yes'),
            \Page\imageLink('No, return back', "../$escapedPageQuery", 'no')
        )
    );

    include_once __DIR__.'/../../echo_page.php';
    echo_page($user, 'Remove Recipient?', $content, '../../../../');

}
