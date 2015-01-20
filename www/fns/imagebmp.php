<?php

function imagebmp ($image, $filename = false) {

    if (!$image) return false;

    if ($filename === false) $filename = 'php://output';
    $f = fopen($filename, 'w');
    if (!$f) return false;

    $width = imagesx($image);
    $height = imagesy($image);

    $bpLine = $width * 3;
    $stride = ($bpLine + 3) & ~3;
    $sizeImage = $stride * $height;
    $offBits = 54;
    $size = $offBits + $sizeImage;

    fwrite($f, 'BM', 2);
    fwrite($f, pack('VvvV', $size, 0, 0, $offBits));

    $data = pack('VVVvvVVVVVV', 40, $width,
        $height, 1, 24, 0, $sizeImage, 0, 0, 0, 0);
    fwrite($f, $data);

    $numpad = $stride - $bpLine;
    for ($y = $height - 1; $y >= 0; $y--) {
        for ($x = 0; $x < $width; $x++) {
            $col = imagecolorat($image, $x, $y);
            fwrite($f, pack('V', $col), 3);
        }
        for ($i = 0; $i < $numpad; $i++) fwrite($f, pack('C', 0));
    }

    fclose($f);

    return true;

}
