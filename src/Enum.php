<?php

namespace Dictionary;

abstract class Enum extends BaseEnum
{
    /**
     * @param mixed $value
     */
    final public function __construct($value)
    {
        parent::__construct($value);
    }

    /**
     * {@inheritdoc}
     */
    public function eq($value): bool
    {
        if (!is_object($value)) {
            return ($this->value == $value);
        }

        Assert::isTrue(
            is_a($value, get_class($this)),
            "'{class}' is not a valid class",
            ['{class}' => get_class($this)]
        );
        /* @var Enum $value */

        return ($this->getValue() == $value->getValue());
    }

    /**
     * {@inheritdoc}
     */
    final protected static function isStrict(): bool
    {
        return false;
    }
}
