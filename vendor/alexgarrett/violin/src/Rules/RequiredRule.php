<?php

namespace Violin\Rules;

use Violin\Contracts\RuleContract;

class RequiredRule implements RuleContract
{
    public function run($value, $input, $args)
    {
        $value = preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $value);

        return !empty($value);
    }

    public function error()
    {
        return 'Поле обязательно.';
    }

    public function canSkip()
    {
        return false;
    }
}
