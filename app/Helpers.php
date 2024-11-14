<?php

if (!function_exists('censorBadWords')) {
    function censorBadWords($text) {
        $badWords = ['badwords', 'badwords1','badwords2', 'badwords3','badwords4', 'badwords5']; // Add your list of bad words here
        
        $censored = $text;

        foreach ($badWords as $badWord) {
            $censored = preg_replace('/\b' . preg_quote($badWord, '/') . '\b/i', str_repeat('*', strlen($badWord)), $censored);
        }

        return $censored;
    }
}
