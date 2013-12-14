<?php

include_once __DIR__.'/../fns/str_collapse_spaces.php';

class Tags {

    const MAX_NUM_TAGS = 5;

    static function parse ($tagnames) {
        $tagnames = str_collapse_spaces($tagnames);
        if ($tagnames === '') return array();
        $tagnames = explode(' ', $tagnames);
        $tagnames = array_unique($tagnames);
        return $tagnames;
    }

}
