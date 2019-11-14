<?php


namespace App\ValueObject;


final class PostIsPublic
{
    private $value;

    /**
     * PostIsPublic constructor.
     * @param bool $value
     */
    private function __construct(bool $value)
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function getValue(): bool
    {
        return $this->value;
    }

    /**
     * @param bool $value
     * @return PostIsPublic
     */
    public static function of(bool $value): PostIsPublic
    {
        return new self($value);
    }
}