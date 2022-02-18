<?php

class CssThemeBasedOnEnvironment
{
    function css(): array
    {
        $username = $_GET["username"];

        if (empty($username)) {
            return [];
        }

        if (str_contains($username, 'staging') || str_contains($username, 'test')) {
            $filename = 'plugins/css/adminer-staging.css';
        } elseif (str_contains($username, 'acceptance') || str_contains($username, 'accp')) {
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
