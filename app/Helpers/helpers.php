<?php

// Include all PHP files in the helpers directory except for this file
// so we only need to include this one file on composer.json files section.
foreach (glob(__DIR__ . '/*.php') as $filename) {
    if ($filename !== __FILE__) {
        require_once $filename;
    }
}
