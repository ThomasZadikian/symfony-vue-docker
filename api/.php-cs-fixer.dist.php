<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude(['vendor', 'node_modules']);

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,

        'array_syntax' => ['syntax' => 'short'],

        'ordered_imports' => ['sort_algorithm' => 'alpha'],

        'no_unused_imports' => true,

        'single_quote' => true,

        'no_extra_blank_lines' => true,

        'binary_operator_spaces' => ['default' => 'single_space'],

        'concat_space' => ['spacing' => 'one'],

        'trim_array_spaces' => true,

        'whitespace_after_comma_in_array' => true,

        'blank_line_after_opening_tag' => true,

        'declare_strict_types' => true,

        'no_whitespace_in_blank_line' => true,

        'class_attributes_separation' => [
            'elements' => [
                'method' => 'one',
                'property' => 'one',
                'trait_import' => 'none',
            ],
        ],

        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline',
        ],

        'phpdoc_align' => ['align' => 'vertical'],

        'phpdoc_types_order' => [
            'null_adjustment' => 'always_last',
            'sort_algorithm' => 'none',
        ],
    ])
    ->setFinder($finder);
