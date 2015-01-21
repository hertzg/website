<?php

$subgroupKey = 'transaction';

include_once '../../fns/wallet/get_subgroups.php';
$subgroup = wallet\get_subgroups()[$subgroupKey];

include_once '../../fns/wallet/transaction/get_methods.php';
include_once '../../fns/subgroup_page.php';
subgroup_page('wallet', $subgroup, $subgroupKey, wallet\transaction\get_methods());
