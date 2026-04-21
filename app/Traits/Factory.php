<?php

declare(strict_types=1);

namespace App\Traits;

trait Factory
{
    public static function factory(...$args): static
    {
        return new static(...$args);
    }
}
