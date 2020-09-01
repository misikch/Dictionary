<?php

namespace Dictionary;

abstract class BaseEnum
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var string[]
     */
    protected $names = [];

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->validate($value);

        $this->value = $value;
    }

    /**
     * @param mixed $value
     * @return static
     */
    final public static function create($value)
    {
        return new static($value);
    }

    /**
     * @return mixed[]
     */
    final public static function getValuesList(): array
    {
        return (new \ReflectionClass(get_called_class()))->getConstants();
    }

    /**
     * @return string[]
     */
    final public static function getNamesList(): array
    {
        $values = static::getValuesList();

        return (new static(reset($values)))->names;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    final public static function contains($value): bool
    {
        return in_array($value, static::getValuesList(), static::isStrict());
    }

    /**
     * @return mixed
     */
    final public function getValue()
    {
        $this->validate($this->value);

        return $this->value;
    }

    /**
     * @return string
     */
    final public function getName(): string
    {
        Assert::isTrue(
            isset($this->names[$this->getValue()]),
            "Name for value '{value}' does not exists",
            ['{value}' => $this->getValue()]
        );

        return $this->names[$this->getValue()];
    }

    /**
     * @param Enum|string $value
     * @return boolean
     */
    abstract public function eq($value): bool;

    /**
     * @return bool
     */
    abstract protected static function isStrict(): bool;

    /**
     * @param mixed $value
     * @return void
     */
    private function validate($value)
    {
        Assert::isTrue(
            static::contains($value),
            "'{value}' is not a valid value for '{name}'", [
                '{value}' => $value,
                '{name}' => get_called_class()
            ]
        );
    }
}
