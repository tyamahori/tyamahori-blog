<?php


namespace App\ValueObject;


use App\Exceptions\ValueObjectError;

final class PostDescription
{
    /**
     * @var string
     */
    private $value;

    /**
     * PostTitle constructor.
     * @param string $value
     * @throws ValueObjectError
     */
    public function __construct(string $value)
    {
        if ($this->isEmpty($value)) {
            throw new ValueObjectError('PostDescription is Empty');
        }

        if (!$this->validateLength($value)) {
            throw new ValueObjectError('PostDescription is too long or short');
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * 文字列が空かを判定
     * @param string $value
     * @return bool
     */
    private function isEmpty(string $value): bool
    {
        return $value === '' || $value === null;
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

    /**
     * @param string $value
     * @return PostDescription
     * @throws ValueObjectError
     */
    public static function of(string $value): PostDescription
    {
        return new self($value);
    }
}