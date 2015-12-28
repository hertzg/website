<?php

$fnsDir = '../../fns';

include_once "$fnsDir/signed_user.php";
$user = signed_user();

unset($_SESSION['help/messages']);

exec('git rev-parse HEAD', $lines);
$commit = htmlspecialchars($lines[0]);
unset($lines);

exec('git describe --tags', $lines);
if (count($lines) === 1) $tag = htmlspecialchars($lines[0]);
else $tag = 'Not available';

include_once "$fnsDir/Form/label.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/imageLink.php";
include_once "$fnsDir/Page/text.php";
$content = Page\create(
    [
        'title' => 'Help',
        'href' => '../#about-zvini',
    ],
    'About Zvini',
    Page\text(
        'This program is free software: you can redistribute it and/or modify'
        .' it under the terms of the GNU Affero General Public License as'
        .' published by the Free Software Foundation, either version 3 of the'
        .' License, or (at your option) any later version.<br /><br />'
        .' This program is distributed in the hope that it will be useful,'
        .' but WITHOUT ANY WARRANTY; without even the implied warranty of'
        .' MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the'
        .' GNU Affero General Public License for more details.<br /><br />'
    )
    .'<div class="hr"></div>'
    .Page\imageLink('GNU Affero General Public License',
        'license/', 'license', ['id' => 'license'])
    .'<div class="hr"></div>'
    .Form\label('Git commit', $commit)
    .'<div class="hr"></div>'
    .Form\label('Git tag', $tag)
);

include_once "$fnsDir/echo_public_page.php";
echo_public_page($user, 'About Zvini', $content, '../../');
