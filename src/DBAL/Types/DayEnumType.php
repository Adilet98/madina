<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class DayEnumType extends AbstractEnumType
{
    public const MONDAY = 1;
    public const TUESDAY = 2;
    public const WEDNESDAY = 3;
    public const THURSDAY = 4;
    public const FRIDAY = 5;

    protected static $choices = [
        self::MONDAY => 'Дүйсенбі',
        self::TUESDAY => 'Сейсенбі',
        self::WEDNESDAY => 'Сәрсенбі',
        self::THURSDAY => 'Бейсенбі',
        self::FRIDAY => 'Жұма'
    ];
}