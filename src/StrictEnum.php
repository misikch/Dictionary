<?php

namespace Dictionary;

abstract class StrictEnum extends BaseEnum
{
    /**
     * @param mixed $value
     */
    final public function __construct($value)
    {
        parent::__construct($value);

        Assert::isTrue(
            $this->isConsistent(static::getValuesList()),
            "Enum '{name}' is not consistent", ['{name}' => get_called_class()]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function eq($value): bool
    {
        if (!is_object($value)) {
            return ($this->value === $value);
        }

        Assert::isTrue(
            is_a($value, get_class($this)),
            "'{class}' is not a valid class",
            ['{class}' => get_class($this)]
        );
        /* @var Enum $value */

        return ($this->getValue() === $value->getValue());
    }

    /**
     * {@inheritdoc}
     */
    final protected static function isStrict(): bool
    {
        return true;
    }

    /**
     * @param mixed[] $valueList
     * @return bool
     */
    private function isConsistent(array $valueList): bool
    {
        $valueTypeList = array_map(
            function ($value) {
                return gettype($value);
            },
            $valueList
        );

        sort($valueTypeList);

        return reset($valueTypeList) === end($valueTypeList);
    }
}
