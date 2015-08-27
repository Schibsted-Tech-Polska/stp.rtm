<?php
$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in(__DIR__ . '/config')
    ->in(__DIR__ . '/module')
    ;
$config = Symfony\CS\Config\Config::create();
$config
    ->level(Symfony\CS\FixerInterface::PSR2_LEVEL)
    ->fixers(array(
        '-remove_lines_between_uses',
        'concat_with_spaces',
        'multiline_array_trailing_comma',
        'namespace_no_leading_whitespace',
        'object_operator',
        'operators_spaces',
        'return',
        'single_array_no_trailing_comma',
        'spaces_before_semicolon',
        'spaces_cast',
        'unused_use',
        'whitespacy_lines',
        'short_array_syntax',
    ))
    ->finder($finder);
return $config;
