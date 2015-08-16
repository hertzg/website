<?php

include_once '../../fns/require_admin.php';
require_admin();

$fnsDir = '../../../fns';

include_once "$fnsDir/request_strings.php";
list($note) = request_strings('note');

include_once "$fnsDir/str_collapse_spaces.php";
$note = str_collapse_spaces($note);

include_once "$fnsDir/Invitations/add.php";
include_once '../../../lib/mysqli.php';
$id = Invitations\add($mysqli, $note);

$_SESSION['admin/users/view/messages'] = ['The user has been saved.'];

include_once "$fnsDir/redirect.php";
redirect("../view/?id=$id");
