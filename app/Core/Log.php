<?php

namespace App\Core;

class Log
{
    public static function writeLog(string $text): string
    {
        $file = fopen(ABSOLUTE_LOG_PATH . DIRECTORY_SEPARATOR .date('Y-m-d').'.log', 'ab');
        $data = '['. date('Y.m.d H:s') . "] $text " . PHP_EOL;
        fwrite($file, $data);

        return $data;
    }
}