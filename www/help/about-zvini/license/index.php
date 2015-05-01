<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/signed_user.php";
$user = signed_user();

include_once "$fnsDir/Form/label.php";
include_once "$fnsDir/Page/phpCode.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/text.php";
$content = Page\tabs(
    [
        [
            'title' => 'About Zvini',
            'href' => '../#license',
        ],
    ],
    'GNU Affero General Public License',
    \Page\phpCode(
        htmlspecialchars(
            file_get_contents('../../../../LICENSE')
        )
    )
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'About Zvini', $content, '../../../');
