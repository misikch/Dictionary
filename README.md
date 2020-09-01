# Dictionary
Dictionary/enum

# Example (how to use):
```php

class SortDirection extends StrictEnum
{
    const ASC = 'asc';

    const DESC = 'desc';

    protected $names =
        [
            self::ASC => 'Asc',
            self::DESC => 'Desc',
        ];

    /**
     * @return static
     */
    public static function asc()
    {
        return new static(static::ASC);
    }

    /**
     * @return static
     */
    public static function desc()
    {
        return new static(static::DESC);
    }

    /**
     * @return bool
     */
    public function isAsc(): bool
    {
        return $this->getValue() === static::ASC;
    }

    /**
     * @return bool
     */
    public function isDesc(): bool
    {
        return $this->getValue() === static::DESC;
    }
}


$enum1 = SortDirection::desc();
$enum2 = new SortDirection(SortDirection::ASC);

```
