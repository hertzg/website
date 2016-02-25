<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/event_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
event_method_page('deleteAll', [], ApiDoc\trueResult(), []);
