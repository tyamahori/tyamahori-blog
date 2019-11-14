<?php


namespace App\ValueObject;


final class CategoryId
{
    /**
     * @var int
     */
    private $value;

    /**
     * PostId constructor.
     * @param int $value
     */
    private function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * 値を取得
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return CategoryId
     */
    public static function of(int $value): CategoryId
    {
        return new self($value);
    }
}