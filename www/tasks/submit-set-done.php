<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-task.php';
include_once '../fns/request_strings.php';
include_once '../classes/Tasks.php';
list($done) = request_strings('done');
Tasks::setDone($idusers, $id, $done);
redirect("view.php?id=$id");
