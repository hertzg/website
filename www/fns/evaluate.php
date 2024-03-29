<?php

function evaluate ($expression, &$error = null,
    &$error_char = null, &$pretty_expression = null,
    &$resolved_expression = null, $value_of = null) {

    $chars = preg_split('/(?<!^)(?!$)/u', $expression);
    $num_chars = count($chars);
    if ($num_chars === 1 && $chars[0] === '') {
        $chars = [];
        $num_chars = 0;
    }

    $operations = [];
    $num_operations = 0;

    $values = [];
    $num_values = 0;

    $divisions = [];

    $value_expected = true;
    $negative_expected = true;
    $operation_expected = false;
    $next_value_sign = 1;
    $empty_brackets = false;
    $opening_bracket_expected = true;

    $pop_operation = function () use (&$operations, &$num_operations) {
        assert($num_operations > 0);
        $num_operations--;
        return array_pop($operations);
    };

    $pop_value = function () use (&$values, &$num_values) {
        assert($num_values > 0);
        $num_values--;
        return array_pop($values);
    };

    $push_operation = function ($operation) use (
        &$operations, &$num_operations) {

        $num_operations++;
        $operations[] = $operation;

    };

    $push_value = function ($value) use (&$values, &$num_values) {
        $num_values++;
        $values[] = $value;
    };

    $apply = function () use ($pop_operation, $pop_value,
        $push_value, &$divisions, &$error, &$error_char) {

        $operation = $pop_operation();
        $b = $pop_value();
        $a = $pop_value();

        if ($operation === '+') {
            $value = $a + $b;
        } elseif ($operation === '-') {
            $value = $a - $b;
        } elseif ($operation === '*') {
            $value = $a * $b;
        } elseif ($operation === '/') {
            $division = array_pop($divisions);
            if ($b === 0.0) {
                $error = 'Division by zero.';
                $error_char = $division;
                return false;
            }
            $value = $a / $b;
        } else {
            assert(false);
        }

        $push_value($value);
        return true;

    };

    $raw_pretty_expression = '';
    $raw_resolved_expression = '';

    $index = 0;
    while ($index < $num_chars) {
        $char = $chars[$index];
        if ($char === ' ') {
            $index++;
        } elseif ($char >= '0' && $char <= '9') {

            if (!$value_expected) {
                $error_char = $index;
                $error = 'Unexpected number.';
                return false;
            }

            $digits = '';
            while (true) {
                $digits .= $char;
                $index++;
                if ($index === $num_chars) break;
                $char = $chars[$index];
                if ($char < '0' || $char > '9') break;
            }
            if ($char === '.') {
                while (true) {
                    $digits .= $char;
                    $index++;
                    if ($index === $num_chars) break;
                    $char = $chars[$index];
                    if ($char < '0' || $char > '9') break;
                }
            }
            $value = floatval($digits) * $next_value_sign;

            $push_value($value);
            $raw_pretty_expression .= $value;
            $raw_resolved_expression .= $value;

            $value_expected = $negative_expected = false;
            $operation_expected = true;
            $empty_brackets = false;
            $opening_bracket_expected = false;

        } elseif ($char === '#' && $value_of !== null) {

            if (!$value_expected) {
                $error_char = $index;
                $error = 'Unexpected variable.';
                return false;
            }

            $id = '';
            while (true) {
                $index++;
                if ($index === $num_chars) break;
                $char = $chars[$index];
                if ($char < '0' || $char > '9') break;
                $id .= $char;
            }
            if ($id === '') {
                $error_char = $index;
                $error = 'Expected variable.';
                return false;
            }
            $value = $value_of($id);
            if ($value === null) {
                $error_char = $index;
                $error = "Unresolvable variable \"#$id\".";
                return false;
            }

            $value = (float)$value;
            $value *= $next_value_sign;
            $push_value($value);
            $raw_pretty_expression .= "#$id";
            $raw_resolved_expression .= $value;

            $value_expected = $negative_expected = false;
            $operation_expected = true;
            $empty_brackets = false;
            $opening_bracket_expected = false;

        } elseif ($char === '+' || $char === '-') {
            if ($operation_expected) {

                while ($operations) {
                    $operation = $operations[$num_operations - 1];
                    if ($operation !== '+' && $operation !== '-' &&
                        $operation !== '*' && $operation !== '/') break;
                    if ($apply() === false) return false;
                }

                $push_operation($char);
                $raw_pretty_expression .= " $char ";
                $raw_resolved_expression .= " $char ";
                $index++;

                $value_expected = true;
                $negative_expected = false;
                $operation_expected = false;
                $next_value_sign = 1;
                $empty_brackets = false;
                $opening_bracket_expected = true;

            } elseif ($char === '-' && $negative_expected) {
                $negative_expected = false;
                $next_value_sign = -1;
                $empty_brackets = false;
                $opening_bracket_expected = true;
                $index++;
            } else {
                $error_char = $index;
                $error = "Unexpected operator \"$char\".";
                return false;
            }
        } elseif ($char === '*' || $char === '/') {

            if (!$operation_expected) {
                $error_char = $index;
                $error = "Unexpected operator \"$char\".";
                return false;
            }

            while ($operations) {
                $operation = $operations[$num_operations - 1];
                if ($operation !== '*' && $operation !== '/') break;
                if ($apply() === false) return false;
            }

            $push_operation($char);
            $raw_pretty_expression .= " $char ";
            $raw_resolved_expression .= " $char ";
            if ($char === '/') $divisions[] = $index;
            $index++;

            $value_expected = true;
            $negative_expected = true;
            $operation_expected = false;
            $next_value_sign = 1;
            $empty_brackets = false;
            $opening_bracket_expected = true;

        } elseif ($char === '(') {

            if (!$opening_bracket_expected) {
                $error_char = $index;
                $error = 'Unexpected opening bracket.';
                return false;
            }

            $empty_brackets = true;
            $push_operation('(');
            $raw_pretty_expression .= '(';
            $raw_resolved_expression .= '(';
            $index++;

            $value_expected = true;
            $negative_expected = true;
            $operation_expected = false;
            $next_value_sign = 1;

        } elseif ($char === ')') {

            if ($empty_brackets) {
                $error_char = $index;
                $error = 'Empty brackets.';
                return false;
            }

            $found = false;
            while ($operations) {
                $operation = $operations[$num_operations - 1];
                if ($operation === '(') {
                    $pop_operation();
                    $value_expected = $negative_expected = false;
                    $operation_expected = true;
                    $found = true;
                    break;
                }
                if ($apply() === false) return false;
            }
            if (!$found) {
                $error_char = $index;
                $error = 'Unbalanced closing bracket.';
                return false;
            }

            $raw_pretty_expression .= ')';
            $raw_resolved_expression .= ')';
            $index++;

        } else {
            $error_char = $index;
            $error = "Unexpected character \"$char\".";
            return false;
        }
    }

    while ($operations) {
        $operation = $operations[$num_operations - 1];
        if ($operation === '(') {
            $error_char = $index;
            $error = 'Expected closing bracket.';
            return false;
        }
        if ($num_values === 1) {
            $error_char = $index;
            $error = 'Expected operand.';
            return false;
        }
        if ($apply() === false) return false;
    }

    if ($num_values === 0) {
        $error_char = $index;
        $error = 'Expected operand.';
        return false;
    }

    $pretty_expression = $raw_pretty_expression;
    $resolved_expression = $raw_resolved_expression;

    return $pop_value();

}
