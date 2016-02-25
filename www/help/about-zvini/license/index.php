<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/signed_user.php";
$user = signed_user();

include_once "$fnsDir/Form/label.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sourceCode.php";
include_once "$fnsDir/Page/text.php";
$content = Page\create(
    [
        'title' => 'About Zvini',
        'href' => '../#license',
        'localNavigation' => true,
    ],
    'GNU Affero General Public License',
    \Page\sourceCode(
        htmlspecialchars(
            file_get_contents('../../../../LICENSE')
        )
    )
);

include_once "$fnsDir/echo_public_page.php";
echo_public_page($user, 'GNU Affero General Public License',
    $content, '../../../');
