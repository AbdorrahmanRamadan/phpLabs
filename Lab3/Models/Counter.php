<?php

class Counter
{
    private static int $count = 0;
    public static function getCount(): int
    {
        return self::$count;
    }
    public static function setCount($count): void
    {
        self::$count = $count;
    }

    public static function increment()
    {
        $file = file("counter.txt");
        $count = $file[0];
        self::setCount($count);
        self::$count += 1;
    }
}