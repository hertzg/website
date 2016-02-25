<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../../fns/require_admin.php';
require_admin();

include_once "$fnsDir/Invitations/request.php";
$note = Invitations\request();

include_once "$fnsDir/Invitations/add.php";
include_once '../../../lib/mysqli.php';
$id = Invitations\add($mysqli, $note, null);

$_SESSION['admin/invitations/view/messages'] = ['Invitation has been saved.'];

include_once "$fnsDir/redirect.php";
redirect("../view/?id=$id");
