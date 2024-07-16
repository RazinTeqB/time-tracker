<?php

namespace App\Enum;

enum TagColor: string
{
    case Valencia = 'Valencia';
    case Crusta = 'Crusta';
    case Saffron = 'Saffron';
    case Conifer = 'Conifer';
    case TurquoisePearl = 'TurquoisePearl';
    case Apple = 'Apple';
    case CuriousBlue = 'CuriousBlue';
    case MediumPurple = 'MediumPurple';
    case PersianPink = 'PersianPink';
    case QuickSilver = 'QuickSilver';
    case Leather = 'Leather';
    case Tundora = 'Tundora';

    public const ALL = [
        self::Valencia->value => [
            'value' => '#D84640',
            'name' => 'Valencia',
        ],

        self::Crusta->value => [
            'value' => '#F78233',
            'name' => 'Crusta',
        ],

        self::Saffron->value => [
            'value' => '#F3BD38',
            'name' => 'Saffron',
        ],

        self::Conifer->value => [
            'value' => '#B1DA33',
            'name' => 'Conifer',
        ],

        self::TurquoisePearl->value => [
            'value' => '#37CECF',
            'name' => 'Turquoise Pearl',
        ],

        self::Apple->value => [
            'value' => '#53C843',
            'name' => 'Apple',
        ],

        self::CuriousBlue->value => [
            'value' => '#2E8DE3',
            'name' => 'Curious Blue',
        ],

        self::MediumPurple->value => [
            'value' => '#9B7CDB',
            'name' => 'Medium Purple',
        ],

        self::PersianPink->value => [
            'value' => '#F47FBD',
            'name' => 'Persian Pink',
        ],

        self::QuickSilver->value => [
            'value' => '#A6A6A6',
            'name' => 'Quick Silver',
        ],

        self::Leather->value => [
            'value' => '#9D6857',
            'name' => 'Leather',
        ],

        self::Tundora->value => [
            'value' => '#4D4D4D',
            'name' => 'Tundora',
        ],
    ];
}
