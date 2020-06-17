<?php

function getLink($badLink, &$result) {
    $len = strlen($badLink);
    if ($len < 7 || substr($badLink, 0, 4) != "http") {
        return false;
    }
    $idx = 4;
    $result = "http";
    if ($badLink[4] == 's') {
        $result = $result . "s";
        $idx = 5;
    }
    $result = $result . "://";
    $result = $result . $badLink[$idx];
    $idx++;
    $fl = false;
    while ($idx < $len) {
        if (substr($badLink, $idx, 2) == "ru") {
            $idx += 2;
            $result = $result . ".ru";
            $fl = true;
            break;
        }
        if (substr($badLink, $idx, 3) == "com") {
            $idx += 3;
            $result = $result . ".com";
            $fl = true;
            break;
        }
        $result = $result . $badLink[$idx];
        $idx++;
    }

    if (!$fl) {
        return false;
    }

    if ($idx != $len) {
        $result = $result . "/" . substr($badLink, $idx);
    }

    return true;
}

$input = fopen("input.txt",'r');
$output = fopen("output.txt", 'w');

$badLink = fgets($input);
$result = "";
if (getLink($badLink, $result)) {
    fwrite($output, $result . "\n");
} else {
    echo "Error";
}

fclose($input);
fclose($output);

?>