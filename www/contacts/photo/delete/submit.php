<?php

include_once '../../../../lib/defaults.php';

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once '../../fns/require_contact.php';
include_once '../../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli, '../');

include_once '../../../fns/Users/Contacts/Photo/delete.php';
Users\Contacts\Photo\delete($mysqli, $contact);

$_SESSION['contacts/view/messages'] = ['The photo has been deleted.'];

include_once '../../../fns/redirect.php';
include_once '../../../fns/ItemList/itemQuery.php';
redirect('../../view/'.ItemList\itemQuery($id));
