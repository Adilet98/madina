<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class LessonTimeEnumType extends AbstractEnumType
{
    public const FIRST_LESSON = 1;
    public const SECOND_LESSON = 2;
    public const THIRD_LESSON = 3;
    public const FOURTH_LESSON = 4;
    public const FIFTH_LESSON = 5;
    public const SIXTH_LESSON = 6;
    public const SEVENTH_LESSON = 7;

    protected static $choices = [
        self::FIRST_LESSON => '1-ші сабақ',
        self::SECOND_LESSON => '2-ші сабақ',
        self::THIRD_LESSON => '3-ші сабақ',
        self::FOURTH_LESSON => '4-ші сабақ',
        self::FIFTH_LESSON => '5-ші сабақ',
        self::SIXTH_LESSON => '6-ші сабақ',
        self::SEVENTH_LESSON => '7-ші сабақ'
    ];
}