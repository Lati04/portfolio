<?php
function loadEnv($path)
{
    if (! file_exists($path)) {
        return [];
    }

    $env = [];

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0 || strpos($line, '=') === false) {
            continue;
        }

        list($name, $value) = explode('=', $line, 2);
        $env[trim($name)]   = trim($value);
    }

    return $env;
}
