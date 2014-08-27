<?php

namespace SendForm\NewItem;

function removeRecipientPage ($user, $username) {

    include_once __DIR__.'/../../ItemList/pageQuery.php';
    $pageQuery = \ItemList\pageQuery();

    include_once __DIR__.'/../../ItemList/pageParams.php';
    $pageParams = \ItemList\pageParams();
    $pageParams['username'] = $username;
    $yesHref = 'submit.php?'.htmlspecialchars(http_build_query($pageParams));

    include_once __DIR__.'/../../ItemList/listHref.php';
    include_once __DIR__.'/../../Page/imageLink.php';
    include_once __DIR__.'/../../Page/tabs.php';
    include_once __DIR__.'/../../Page/text.php';
    include_once __DIR__.'/../../Page/twoColumns.php';
    $content = \Page\tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../../'.\ItemList\listHref(),
            ],
            [
                'title' => 'New',
                'href' => "../../$pageQuery",
            ],
        ],
        'Send',
        \Page\text('Are you sure you want to remove the recipient'
            .' "<b>'.htmlspecialchars($username).'</b>"?')
        .'<div class="hr"></div>'
        .\Page\twoColumns(
            \Page\imageLink('Yes, remove recipient', $yesHref, 'yes'),
            \Page\imageLink('No, return back', "../$pageQuery", 'no')
        )
    );

    include_once __DIR__.'/../../echo_page.php';
    echo_page($user, 'Remove Recipient', $content, '../../../../');

}
