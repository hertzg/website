<?php

function assert_success ($text) {
    return "<div>$text</div>";
}

function assert_enabled ($ok, $subject) {
    if ($ok) return assert_success("$subject is enabled.");
    return assert_failure("$subject is NOT enabled.");
}

function assert_failure ($text) {
    return "<div class=\"not_ok colorText red\">$text</div>";
}

function assert_file ($path) {
    $subject = "\"$path\"";
    if (is_file($path)) return assert_success("$subject is a file.");
    return assert_failure("$subject is NOT a file.");
}

function assert_folder ($path) {
    $subject = "\"$path\"";
    if (is_dir($path)) return assert_success("$subject is a folder.");
    return assert_failure("$subject is NOT a folder.");
}

function assert_installed ($ok, $subject) {
    if ($ok) return assert_success("$subject is installed.");
    return assert_failure("$subject is NOT installed.");
}

function assert_readable ($path) {
    $subject = "\"$path\"";
    if (is_readable($path)) return assert_success("$subject is readable.");
    return assert_failure("$subject is NOT readable.");
}

function assert_readable_file ($path) {
    return assert_file($path).assert_writable($path);
}

function assert_writable ($path) {
    $subject = "\"$path\"";
    if (is_writable($path)) return assert_success("$subject is writable.");
    return assert_failure("$subject is NOT writable.");
}

function assert_writable_file ($path) {
    return assert_file($path).assert_readable($path).assert_writable($path);
}

function assert_writable_folder ($path) {
    return assert_folder($path).assert_writable($path);
}
