<?php

include_once '../lib/mysqli.php';

$mysqli->query(
    'alter table contacts'
    .' add alias varchar(32) character set utf8 collate utf8_unicode_ci not null after fullname'
);

$mysqli->query(
    'alter table contacttags'
    .' add alias varchar(32) character set utf8 collate utf8_unicode_ci not null after fullname'
);
