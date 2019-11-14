<?php


namespace App\ValueObject;


use App\Exceptions\ValueObjectError;

final class PostContent
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
            throw new ValueObjectError('PostContent is Empty');
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
     * @param string $value
     * @return PostContent
     * @throws ValueObjectError
     */
    public static function of(string $value): PostContent
    {
        return new self($value);
    }
}