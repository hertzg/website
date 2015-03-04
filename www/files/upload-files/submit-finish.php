<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_parent_folder.php';
include_once '../../lib/mysqli.php';
list($parentFolder, $parent_id_folders, $user) = require_parent_folder($mysqli);

include_once "$fnsDir/request_strings.php";
list($num_files) = request_strings('num_files');

$num_files = abs((int)$num_files);

if ($num_files == 1) $message = '1 file has been uploaded.';
else $message = "$num_files files have been uploaded.";

unset($_SESSION['files/errors']);
$_SESSION['files/id_folders'] = $parent_id_folders;
$_SESSION['files/messages'] = [$message];

include_once "$fnsDir/create_folder_link.php";
include_once "$fnsDir/redirect.php";
redirect(create_folder_link($parent_id_folders, '../'));
