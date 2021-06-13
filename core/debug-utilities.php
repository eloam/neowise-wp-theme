<?php

class Console {

    public static function log($output, $withScriptTags = true) {
        $jsCode = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
        if ($withScriptTags) {
            $jsCode = '<script>' . $jsCode . '</script>';
        }
        echo $jsCode;
    }

    public static function warn($output, $withScriptTags = true) {
        $jsCode = 'console.warn(' . json_encode($output, JSON_HEX_TAG) . ');';
        if ($withScriptTags) {
            $jsCode = '<script>' . $jsCode . '</script>';
        }
        echo $jsCode;
    }

    public static function error($output, $withScriptTags = true) {
        $jsCode = 'console.error(' . json_encode($output, JSON_HEX_TAG) . ');';
        if ($withScriptTags) {
            $jsCode = '<script>' . $jsCode . '</script>';
        }
        echo $jsCode;
    }

    public static function info($output, $withScriptTags = true) {
        $jsCode = 'console.info(' . json_encode($output, JSON_HEX_TAG) . ');';
        if ($withScriptTags) {
            $jsCode = '<script>' . $jsCode . '</script>';
        }
        echo $jsCode;
    }

}