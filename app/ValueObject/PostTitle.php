<?php


namespace App\ValueObject;


use App\Exceptions\ValueObjectError;

final class PostTitle
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
            throw new ValueObjectError('PostTitle is Empty');
        }

        if (!$this->validateLength($value)) {
            throw new ValueObjectError('PostTitle is too long or short');
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
     * @param string $value
     * @return PostTitle
     * @throws ValueObjectError
     */
    public static function of(string $value): PostTitle
    {
        return new self($value);
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
}