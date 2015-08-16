<?php

include_once '../fns/require_admin.php';
require_admin();

$fnsDir = '../../fns';

unset(
    $_SESSION['admin/invitations/view/messages'],
    $_SESSION['admin/messages']
);

include_once "$fnsDir/Invitations/index.php";
include_once '../../lib/mysqli.php';
$invitations = Invitations\index($mysqli);

$items = [];
if ($invitations) {
    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    foreach ($invitations as $invitation) {
        $id = $invitation->id;
        $note = $invitation->note;
        $href = "view/?id=$id";
        $icon = 'generic';
        $options = ['id' => $id];
        $key = bin2hex($invitation->key);
        if ($note === '') {
            $link = Page\imageArrowLink($key, $href, $icon, $options);
        } else {
            $link = Page\imageArrowLinkWithDescription(
                htmlspecialchars($note), $key, $href, $icon, $options);
        }
        $items[] = $link;
    }
} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No invitations');
}

include_once "$fnsDir/Page/newItemButton.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Administration',
            'href' => '../#invitations',
        ],
    ],
    'Invitations',
    Page\sessionErrors('admin/invitations/errors')
    .Page\sessionMessages('admin/invitations/messages')
    .join('<div class="hr"></div>', $items),
    Page\newItemButton('new/', 'Invitation')
);

include_once "$fnsDir/echo_guest_page.php";
echo_guest_page('Invitations', $content, '../../');
