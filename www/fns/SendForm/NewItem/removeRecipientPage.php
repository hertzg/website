<?php

namespace SendForm\NewItem;

function removeRecipientPage ($mysqli, $user,
    $username, $what_upper, $what_lower, $recipients) {

    $base = '../../../../';
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $escapedPageQuery = \ItemList\escapedPageQuery();

    include_once "$fnsDir/ItemList/pageParams.php";
    $pageParams = \ItemList\pageParams();
    $pageParams['username'] = $username;
    $yesHref = 'submit.php?'.htmlspecialchars(http_build_query($pageParams));

    include_once "$fnsDir/Contacts/indexWithUsernameOnUser.php";
    $contacts = \Contacts\indexWithUsernameOnUser($mysqli, $user->id_users);

    include_once "$fnsDir/Page/confirmDialog.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/twoColumns.php";
    include_once "$fnsDir/Page/text.php";
    include_once __DIR__.'/../recipientsPanels.php';
    $content =
        \Page\create(
            [
                'title' => "New $what_upper",
                'href' => "../../$escapedPageQuery",
            ],
            'Send',
            \Page\text("Send the new $what_lower to:")
            .\SendForm\recipientsPanels($recipients,
                $contacts, $pageParams, '../')
        )
        .\Page\confirmDialog('Are you sure you want to remove the recipient'
            .' "<b>'.htmlspecialchars($username).'</b>"?',
            'Yes, remove recipient', $yesHref, "../$escapedPageQuery");

    include_once "$fnsDir/compressed_css_link.php";
    include_once "$fnsDir/echo_user_page.php";
    echo_user_page($user, 'Remove Recipient?', $content, $base, [
        'head' => compressed_css_link('confirmDialog', $base),
    ]);

}
