<?php


namespace App\ValueObject;


use App\Exceptions\ValueObjectError;
use App\Models\Category;

final class CategoryName
{
    /**
     * @var string
     */
    private $value;

    /**
     * PostId constructor.
     * @param string $value
     * @throws ValueObjectError
     */
    private function __construct(string $value)
    {
        if (!$this->validateLength($value)) {
            throw new ValueObjectError(Category::class . ': Category is too long or short');
        }
        $this->value = $value;
    }

    /**
     * 値を取得
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return CategoryName
     * @throws ValueObjectError
     */
    public static function of(string $value): CategoryName
    {
        return new self($value);
    }

    /**
     * 文字数のカウント
     * @param string $value
     * @return bool
     */
    private function validateLength(string $value): bool
    {
        $counts = mb_strlen($value);
        return 0 < $counts && $counts <= 255;
    }
}