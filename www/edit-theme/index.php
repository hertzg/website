<?php

include_once '../fns/require_user.php';
$user = require_user('../');
$idusers = $user->idusers;

unset($_SESSION['account/index_messages']);

include_once '../fns/get_themes.php';
$themes = get_themes();

include_once '../fns/Page/imageLink.php';
$themeItems = array();
foreach ($themes as $id => $theme) {
    $href = "submit.php?theme=$id";
    if ($id == $user->theme) {
        $theme .= ' (Current)';
    }
    $themeItems[] = Page\imageLink($theme, $href, "$id-theme");
}

include_once '../fns/Page/warnings.php';
$pageWarnings = Page\warnings(array('Select theme color:'));

include_once '../fns/create_tabs.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '..',
            ),
            array(
                'title' => 'Account',
                'href' => '../account/',
            ),
        ),
        'Edit Theme',
        $pageWarnings.join('<div class="hr"></div>', $themeItems)
    );

include_once '../fns/echo_page.php';
echo_page($user, 'Edit Theme', $content, '../');
