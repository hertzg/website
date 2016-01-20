<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once "$fnsDir/request_strings.php";
list($id) = request_strings('id');

$id = abs((int)$id);

include_once "$fnsDir/NoteRevisions/getNotDeletedOnUser.php";
include_once '../../../lib/mysqli.php';
$revision = NoteRevisions\getNotDeletedOnUser($mysqli, $user->id_users, $id);

if (!$revision) {
    include_once "$fnsDir/redirect.php";
    redirect('../..');
}

$id_notes = $revision->id_notes;

if ($revision->password_protect) {

    include_once "$fnsDir/Session/EncryptionKey/get.php";
    $encryption_key = \Session\EncryptionKey\get();

    if ($encryption_key === null) $text = '****';
    else {

        include_once "$fnsDir/Crypto/decrypt.php";
        $text = \Crypto\decrypt($encryption_key,
            $revision->encrypted_text, $revision->encrypted_text_iv);

        if ($text === false) $text = '****';

    }

} else {
    $text = $revision->text;
}

include_once "$fnsDir/Page/text.php";
$items = [\Page\text(nl2br(htmlspecialchars($text)))];

$tags = $revision->tags;
if ($tags !== '') $items[] = \Page\text('Tags: '.htmlspecialchars($tags));

if ($revision->encrypt_in_listings) {
    $infoText = 'Encrypted in listings.<br />';
} else {
    $infoText = '';
}
if ($revision->password_protect) $infoText .= 'Password-protected.<br />';

include_once "$fnsDir/export_date_ago.php";
$infoText .= 'Revision made '.export_date_ago($revision->insert_time).'.';

$title = "Note #{$id_notes} R".($revision->revision + 1);

include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/infoText.php";
$content = Page\create(
    [
        'title' => 'History',
        'href' => "../?id=$id_notes#$id",
    ],
    $title,
    join('<div class="hr"></div>', $items)
    .Page\infoText($infoText)
);

include_once "$fnsDir/compressed_js_script.php";
include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, $title, $content, $base, [
    'scripts' => compressed_js_script('dateAgo', $base),
]);
