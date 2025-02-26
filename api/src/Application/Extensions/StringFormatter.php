<?php

declare(strict_types=1);

namespace App\Application\Extensions;

class StringFormatter
{
    /**
     * Convert a string to camel case.
     *
     * @param  string $string
     * @return string
     */
    public function toCamelCase(string $string): string
    {
        $result = strtolower($string);
        preg_match_all('/[a-zA-Z0-9]+/', $result, $matches);
        $result = '';
        foreach ($matches[0] as $match) {
            $result .= ucfirst($match);
        }
        return lcfirst($result);
    }

    /**
     * Convert a string to snake case.
     *
     * @param  string $string
     * @return string
     */
    public function toSnakeCase(string $string): string
    {
        $result = strtolower(preg_replace('/[A-Z]/', '_$0', lcfirst($string)));
        return str_replace(' ', '_', $result);
    }

    /**
     * Convert a string to kebab case.
     *
     * @param  string $string
     * @return string
     */
    public function toKebabCase(string $string): string
    {
        $result = strtolower(preg_replace('/[A-Z]/', '-$0', lcfirst($string)));
        return str_replace(' ', '-', $result);
    }
}
