<?php

namespace App\Enums;

enum CountryCode: string
{
    case UnitedStates = 'US';
    case Canada = 'CA';
    case UnitedKingdom = 'GB';
    case Germany = 'DE';
    case France = 'FR';
    case Australia = 'AU';
    case Tanzania = 'TZ';
    case Kenya = 'KE';
    case SouthAfrica = 'ZA';
    case Nigeria = 'NG';

    public function getName(): string
    {
        return match ($this) {
            self::UnitedStates => 'United States',
            self::Canada => 'Canada',
            self::UnitedKingdom => 'United Kingdom',
            self::Germany => 'Germany',
            self::France => 'France',
            self::Australia => 'Australia',
            self::Tanzania => 'Tanzania',
            self::Kenya => 'Kenya',
            self::SouthAfrica => 'South Africa',
            self::Nigeria => 'Nigeria',
        };
    }
}
