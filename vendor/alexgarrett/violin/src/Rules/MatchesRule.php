<?php

namespace Violin\Rules;

use Violin\Contracts\RuleContract;

class MatchesRule implements RuleContract
{
    public function run($value, $input, $args)
    {
        return $value === $input[$args[0]];
    }

    public function error()
    {
        return '{field} должно совпадать с {$0}.';
    }

    public function canSkip()
    {
        return true;
    }
}
