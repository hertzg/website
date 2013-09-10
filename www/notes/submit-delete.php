<?php

include_once 'lib/require-note.php';
include_once '../fns/redirect.php';
include_once '../classes/Notes.php';
Notes::delete($idusers, $id);
$_SESSION['notes/index_messages'] = array('Note has been deleted.');
redirect();
