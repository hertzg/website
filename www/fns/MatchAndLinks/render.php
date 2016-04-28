<?php

namespace MatchAndLinks;

function render ($base, $text, $includes) {

    $text = htmlspecialchars($text);

    $match = function ($regex, $callback) use ($text) {
        $flags = PREG_OFFSET_CAPTURE | PREG_SET_ORDER;
        preg_match_all($regex, $text, $matches, $flags);
        foreach ($matches as $match) {
            $value = $match[0][0];
            $start = $match[0][1];
            $callback($value, $start, $start + strlen($value));
        }
    };

    $parts = [];

    $regex = '#(?:ftps?|https?|sftp)://\S+#';
    $match($regex, function ($value, $start, $end) use (&$parts) {
        $parts[] = [
            'type' => 'linkStart',
            'index' => $start,
            'value' => $value,
        ];
        $parts[] = [
            'type' => 'linkEnd',
            'index' => $end,
        ];
    });

    include_once __DIR__.'/../keyword_regex.php';
    $regex = keyword_regex($includes);

    $match($regex, function ($value, $start, $end) use (&$parts) {
        $parts[] = [
            'type' => 'keywordStart',
            'index' => $start,
        ];
        $parts[] = [
            'type' => 'keywordEnd',
            'index' => $end,
        ];
    });

    usort($parts, function ($a, $b) {
        return $a['index'] - $b['index'];
    });

    include_once __DIR__.'/normalizedParts.php';
    $normalizedParts = normalizedParts($parts);

    foreach ($normalizedParts as $i => $normalizedPart) {
        $type = $normalizedPart['type'];
        if ($type == 'linkStart') {
            $url = html_entity_decode($normalizedPart['value']);
            include_once __DIR__.'/../create_external_url.php';
            $href = htmlspecialchars(create_external_url($url, $base));
            $html = "<a class=\"a\" rel=\"noreferrer\" href=\"$href\">";
        } elseif ($type == 'linkEnd') {
            $html = '</a>';
        } elseif ($type == 'keywordStart') {
            $html = '<mark>';
        } elseif ($type == 'keywordEnd') {
            $html = '</mark>';
        }
        $normalizedParts[$i]['html'] = $html;
    }

    $processedText = $text;
    while ($normalizedParts) {
        $part = array_shift($normalizedParts);
        $index = $part['index'];
        $leading = substr($processedText, 0, $index);
        $trailing = substr($processedText, $index);
        $html = $part['html'];
        $processedText = "$leading$html$trailing";
        $htmlLength = strlen($html);
        foreach ($normalizedParts as $i => $part) {
            $normalizedParts[$i]['index'] += $htmlLength;
        }
    }

    return $processedText;

}
