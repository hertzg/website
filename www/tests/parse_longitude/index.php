#!/usr/bin/php
<?php

include_once '../../../lib/defaults.php';

chdir(__DIR__);
include_once 'fns/visual_assert.php';

visual_assert('0', 0);

visual_assert('1', 1);
visual_assert('-1', -1);

visual_assert('1.5', 1.5);
visual_assert('-1.5', -1.5);

visual_assert('90', 90);
visual_assert('-90', -90);

visual_assert('200', -180);
visual_assert('-200', -180);

visual_assert('12.345678', 12.345678);
visual_assert('-12.345678', -12.345678);

visual_assert('1 e', 1);
visual_assert('1 w', -1);

visual_assert('1 E', 1);
visual_assert('1 W', -1);

visual_assert('1°E', 1);
visual_assert('1°W', -1);

visual_assert('1 1 E', 1.016667);
visual_assert('1 1 W', -1.016667);

visual_assert('1°1 E', 1.016667);
visual_assert('1°1 W', -1.016667);

visual_assert('1 1′E', 1.016667);
visual_assert('1 1′W', -1.016667);

visual_assert('1°1′E', 1.016667);
visual_assert('1°1′W', -1.016667);

visual_assert('1 1 1 E', 1.016944);
visual_assert('1 1 1 W', -1.016944);

visual_assert('1°1 1 E', 1.016944);
visual_assert('1°1 1 W', -1.016944);

visual_assert('1 1′1 E', 1.016944);
visual_assert('1 1′1 W', -1.016944);

visual_assert('1°1′1 E', 1.016944);
visual_assert('1°1′1 W', -1.016944);

visual_assert('1 1 1″E', 1.016944);
visual_assert('1 1 1″W', -1.016944);

visual_assert('1°1 1″E', 1.016944);
visual_assert('1°1 1″W', -1.016944);

visual_assert('1 1′1″E', 1.016944);
visual_assert('1 1′1″W', -1.016944);

visual_assert('1°1′1″E', 1.016944);
visual_assert('1°1′1″W', -1.016944);

visual_assert('1 1 1.1 E', 1.016947);
visual_assert('1 1 1.1 W', -1.016947);

visual_assert('1°1 1.1 E', 1.016947);
visual_assert('1°1 1.1 W', -1.016947);

visual_assert('1 1′1.1 E', 1.016947);
visual_assert('1 1′1.1 W', -1.016947);

visual_assert('1°1′1.1 E', 1.016947);
visual_assert('1°1′1.1 W', -1.016947);

visual_assert('1 1 1.1″E', 1.016947);
visual_assert('1 1 1.1″W', -1.016947);

visual_assert('1°1 1.1″E', 1.016947);
visual_assert('1°1 1.1″W', -1.016947);

visual_assert('1 1′1.1″E', 1.016947);
visual_assert('1 1′1.1″W', -1.016947);

visual_assert('1°1′1.1″E', 1.016947);
visual_assert('1°1′1.1″W', -1.016947);
