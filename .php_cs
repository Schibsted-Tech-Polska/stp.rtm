<?php
$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in(__DIR__ . '/module')
    ->in(__DIR__ . '/config')
    ;
$config = Symfony\CS\Config\Config::create();
$config->fixers(array(
    'linefeed',
    'trailing_spaces',
    'unused_use',
    'phpdoc_params',
    'return',
    'short_tag',
    'php_closing_tag',
    'extra_empty_lines',
    'controls_spaces',
    'eof_ending',
));
$config->finder($finder);
return $config;
