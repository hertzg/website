<?php

$fnsDir = '../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../home/');

include_once 'fns/require_url.php';
require_url($user, $url, $parsed_url);

include_once "$fnsDir/ApiKey/random.php";
$key = ApiKey\random();

include_once "$fnsDir/CrossSiteApiKeys/add.php";
include_once '../lib/mysqli.php';
CrossSiteApiKeys\add($mysqli, $user->id_users, $key);

if (array_key_exists('query', $parsed_url)) $url .= '&';
else $url .= '?';
$url .= "cross_site_api_key=$key";

include_once "$fnsDir/redirect.php";
redirect($url);
