<?php

include_once '../../../../../lib/defaults.php';

$base = '../../../../';
$fnsDir = '../../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset($_SESSION['account/connections/default/messages']);

include_once "$fnsDir/Form/label.php";
$items = [Form\label('Username', 'Any other username')];

include_once '../../fns/render_checkbox_items.php';
render_checkbox_items([
    'can_send_bookmark' => $user->anonymous_can_send_bookmark,
    'can_send_calculation' => $user->anonymous_can_send_calculation,
    'can_send_channel' => $user->anonymous_can_send_channel,
    'can_send_contact' => $user->anonymous_can_send_contact,
    'can_send_file' => $user->anonymous_can_send_file,
    'can_send_note' => $user->anonymous_can_send_note,
    'can_send_place' => $user->anonymous_can_send_place,
    'can_send_schedule' => $user->anonymous_can_send_schedule,
    'can_send_task' => $user->anonymous_can_send_task,
], $items);

include_once "$fnsDir/Form/button.php";
$items[] = Form\button('Save Changes');

include_once "$fnsDir/Page/create.php";
$content = Page\create(
    [
        'title' => 'Default Connection',
        'href' => '../#edit',
    ],
    'Edit',
    '<form action="submit.php" method="post">'
        .join('<div class="hr"></div>', $items)
    .'</form>'
);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Edit Default Connection', $content, $base, [
    'scripts' => compressed_js_script('formCheckbox', $base),
]);
