#!/usr/bin/php
<?php

function visual_assert ($keyword, $expected_includes, $expected_excludes) {
    parse_keyword($keyword, $includes, $excludes);
    assert($includes === $expected_includes);
    assert($excludes === $expected_excludes);
}

chdir(__DIR__);
include_once '../fns/parse_keyword.php';
visual_assert('', [], []);
visual_assert(' ', [], []);
visual_assert('  ', [], []);
visual_assert(' a', ['a'], []);
visual_assert('a ', ['a'], []);
visual_assert(' a ', ['a'], []);
visual_assert('  a  ', ['a'], []);
visual_assert('a', ['a'], []);
visual_assert('ab', ['ab'], []);
visual_assert('a b', ['a', 'b'], []);
visual_assert('a  b', ['a', 'b'], []);
visual_assert('aa bb', ['aa', 'bb'], []);
visual_assert('ა ბ', ['ა', 'ბ'], []);
visual_assert('-', ['-'], []);
visual_assert('--', [], ['-']);
visual_assert('---', [], ['--']);
visual_assert(' -a', [], ['a']);
visual_assert('-a ', [], ['a']);
visual_assert(' -a ', [], ['a']);
visual_assert('  -a  ', [], ['a']);
visual_assert('-a', [], ['a']);
visual_assert('-ab', [], ['ab']);
visual_assert('-a -b', [], ['a', 'b']);
visual_assert('-a  -b', [], ['a', 'b']);
visual_assert('-aa -bb', [], ['aa', 'bb']);
visual_assert('-ა -ბ', [], ['ა', 'ბ']);
visual_assert('a -b', ['a'], ['b']);
visual_assert('-a b', ['b'], ['a']);
visual_assert('-"a b"', [], ['a b']);
visual_assert('--"a b"', ['b"'], ['-"a']);
visual_assert('  "a"  ', ['a'], []);
visual_assert('  "ab"  ', ['ab'], []);
visual_assert('  "a b"  ', ['a b'], []);
visual_assert('  "a  b"  ', ['a  b'], []);
visual_assert('  "a b"  "c d"', ['a b', 'c d'], []);
visual_assert('"a b" "c d"', ['a b', 'c d'], []);
visual_assert('"a b""c d"', ['a b"c d'], []);
visual_assert('"a b', ['a b'], []);
visual_assert('a b"', ['a', 'b"'], []);
visual_assert('""', [], []);
visual_assert('a "" b', ['a', 'b'], []);
visual_assert('a b "', ['a', 'b'], []);
visual_assert('a - b', ['a', '-', 'b'], []);
visual_assert('a  -  b', ['a', '-', 'b'], []);
visual_assert('a  -', ['a', '-'], []);
visual_assert('-  a', ['-', 'a'], []);
visual_assert('a a', ['a'], []);
visual_assert('- -', ['-'], []);
visual_assert('"a b" "a b" "c d"', ['a b', 'c d'], []);
visual_assert('1 1 2 2', ['1', '2'], []);
