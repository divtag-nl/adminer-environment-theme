<?php

class CssThemeBasedOnEnvironment
{
    function css(): array
    {
        $name = $_GET["db"] ?? '';

        if (empty($name)) {
            $name = $_GET["username"] ?? '';
        }

        if (empty($name)) {
            return [];
        }

        if (str_contains($name, 'staging') || str_contains($name, 'test') || str_contains($name, 'beta')) {
            $filename = 'plugins/css/adminer-staging.css';
        } elseif (str_contains($name, 'acceptance') || str_contains($name, 'accp')) {
            $filename = 'plugins/css/adminer-acceptance.css';
        } else {
            $filename = 'plugins/css/adminer-production.css';
        }


        if (file_exists($filename)) {
            $return[] = "$filename?v=" . crc32(file_get_contents($filename));
        }

        return $return ?? [];
    }
}
