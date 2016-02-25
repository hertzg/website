<?php

include_once '../../../../lib/defaults.php';

include_once '../fns/require_received_contact.php';
include_once '../../../lib/mysqli.php';
list($contact, $id, $user) = require_received_contact($mysqli);

header('Content-Type: text/vcard; charset=UTF-8');

include_once '../../fns/contact_vcf.php';
echo contact_vcf($contact);
