<?php

namespace App\ValueObject;

use Carbon\Carbon;

final class Date
{
    /**
     * @var Carbon
     */
    private $value;

    /**
     * PostId constructor.
     * @param Carbon $value
     */
    private function __construct(Carbon $value)
    {
        $this->value = $value;
    }

    /**
     * 値を取得
     * @return Carbon
     */
    public function getValue(): Carbon
    {
        return $this->value;
    }

    /**
     * @param Carbon $value
     * @return Date
     */
    public static function of(Carbon $value): Date
    {
        return new self($value);
    }

}