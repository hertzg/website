<?php

namespace phpCode;

function arrayKeyValue ($key, $value) {
    return "$key ".keyword('=>')." $value".keyword(',');
}

function assignment ($leftValue, $rightValue) {
    return "$leftValue ".keyword('=')." $rightValue";
}

function commaSeparate () {
    return join(keyword(',').' ', func_get_args());
}

function comment ($value) {
    return "<span class=\"comment\">// $value</span>\n";
}

function comparison ($leftValue, $operation, $rightValue) {
    return "$leftValue ".keyword($operation)." $rightValue";
}

function concat () {
    return join(keyword('.'), func_get_args());
}

function constant ($value) {
    return "<span class=\"constant\">$value</span>";
}

function curlyBrackets ($value) {
    return keyword('{').$value.keyword('}');
}

function functionCall ($name, $arguments = '') {
    return $name.parentheses($arguments);
}

function ifStatement ($condition, $statements) {
    return keyword('if').' '.parentheses($condition).' '.$statements;
}

function indent () {
    $html = '';
    foreach (func_get_args() as $line) $html .= "    $line";
    return $html;
}

function keyword ($value) {
    return "<span class=\"keyword\">$value</span>";
}

function number ($value) {
    return "<span class=\"number\">$value</span>";
}

function parentheses ($value) {
    return keyword('(').$value.keyword(')');
}

function squareBrackets ($value) {
    return keyword('[').$value.keyword(']');
}

function stringLiteral ($value) {
    return "<span class=\"string\">'$value'</span>";
}

function statement ($value) {
    return $value.keyword(';')."\n";
}

function variable ($value) {
    return "<span class=\"variable\">\$$value</span>";
}
