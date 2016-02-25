<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_invitation.php';
include_once '../../../lib/mysqli.php';
list($invitation, $id) = require_invitation($mysqli);

include_once "$fnsDir/Invitations/request.php";
$note = Invitations\request();

if ($invitation->note === $note) {
    $message = 'No changes to be saved.';
} else {
    $message = 'Changes have been saved.';
    include_once "$fnsDir/Invitations/edit.php";
    Invitations\edit($mysqli, $id, $note, null);
}

$_SESSION['admin/invitations/view/messages'] = [$message];

include_once "$fnsDir/redirect.php";
redirect("../view/?id=$id");
