<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class RoleEnumType extends AbstractEnumType
{
    public const ROLE_TEACHER = 'ROLE_TEACHER';
    public const ROLE_STUDENT = 'ROLE_STUDENT';
    public const ROLE_ADMIN = 'ROLE_ADMIN';

    protected static $choices = [
        self::ROLE_TEACHER => 'Преподаватель',
        self::ROLE_STUDENT => 'Ученик',
        self::ROLE_ADMIN => 'Администратор'
    ];
}