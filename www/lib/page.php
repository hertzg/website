<?php

include_once 'user.php';
include_once __DIR__.'/../classes/Page.php';
$page = new Page;
$page->theme = $user ? $user->theme : 'orange';
