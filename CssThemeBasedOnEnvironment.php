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


        if (!file_exists($filename)) {
            return [];
        }

        // The value '' tells Adminer the stylesheet supports light and dark mode, so it also loads its own
        // dark.css (with the dark syntax highlighting colors) under prefers-color-scheme: dark.
        // A plain list is treated as light-only, which leaves the SQL highlighting dark on a dark background.
        return ["$filename?v=" . crc32(file_get_contents($filename)) => ''];
    }
}
