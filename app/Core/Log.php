<?php

namespace App\Core;

class Log
{
    public static function writeLog(string $text): string
    {
        $file = fopen(RELATIVE_LOG_PATH . date('Y-m-d').'.log', 'ab');
        
        if($file === false) {
            return 'Error write log. ' . 'Error Message: ' . $text;
        }

        $data = '['. date('Y.m.d H:s') . "] $text " . PHP_EOL;
        fwrite($file, $data);

        return $data;
    }
}