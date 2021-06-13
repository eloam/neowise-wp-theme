<?php

namespace NwComponents;

class Utilities {

    public static function formatPath(string $str): string {
        $str = str_replace('\\', '/', $str);
        $str = preg_replace('/\/+/', '/', $str);
        $str = trim($str, '/');
        $str = trim($str, '\\');
    
        return $str;
    }

    public static function relativePathExists(string $path): bool {
        $formattedPath = Utilities::formatPath($path);
        return file_exists(get_template_directory() . '/' . $formattedPath);
    }
}