<?php

namespace Dictionary;

class Assert
{
    /**
     * @param boolean $assertion
     * @param string $description
     * @param string[] $descriptionParameters
     * @return void
     * @throws AssertException
     */
    public static function isTrue($assertion, $description = '', array $descriptionParameters = [])
    {
        if (!$assertion) {
            throw new AssertException(self::formatDescription($description, $descriptionParameters));
        }
    }

    /**
     * @param boolean $assertion
     * @param string $description
     * @param string[] $descriptionParameters
     * @return void
     * @throws AssertException
     */
    public static function isFalse($assertion, $description = '', array $descriptionParameters = [])
    {
        if ($assertion) {
            throw new AssertException(self::formatDescription($description, $descriptionParameters));
        }
    }

    /**
     * @param string $description
     * @param string[] $descriptionParameters
     * @return string
     */
    private static function formatDescription($description = '', array $descriptionParameters = [])
    {
        return empty($descriptionParameters) ? $description : strtr($description, $descriptionParameters);
    }
}
