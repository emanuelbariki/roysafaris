<?php

namespace App\Enums;

enum Country: string
{
    // African Countries
    case TANZANIA = 'Tanzania';
    case KENYA = 'Kenya';
    case UGANDA = 'Uganda';
    case RWANDA = 'Rwanda';
    case BURUNDI = 'Burundi';
    case SOUTH_AFRICA = 'South Africa';
    case NAMIBIA = 'Namibia';
    case BOTSWANA = 'Botswana';
    case ZAMBIA = 'Zambia';
    case ZIMBABWE = 'Zimbabwe';
    case MOZAMBIQUE = 'Mozambique';
    case ETHIOPIA = 'Ethiopia';
    case SUDAN = 'Sudan';
    case EGYPT = 'Egypt';
    case MOROCCO = 'Morocco';
    case NIGERIA = 'Nigeria';
    case GHANA = 'Ghana';
    case SENEGAL = 'Senegal';
    case IVORY_COAST = 'Ivory Coast';
    case CAMEROON = 'Cameroon';

    // European Countries
    case UNITED_KINGDOM = 'United Kingdom';
    case FRANCE = 'France';
    case GERMANY = 'Germany';
    case ITALY = 'Italy';
    case SPAIN = 'Spain';
    case NETHERLANDS = 'Netherlands';
    case SWITZERLAND = 'Switzerland';
    case BELGIUM = 'Belgium';
    case AUSTRIA = 'Austria';
    case SWEDEN = 'Sweden';
    case NORWAY = 'Norway';
    case DENMARK = 'Denmark';
    case FINLAND = 'Finland';
    case PORTUGAL = 'Portugal';
    case GREECE = 'Greece';
    case IRELAND = 'Ireland';

    // North American Countries
    case UNITED_STATES = 'United States';
    case CANADA = 'Canada';
    case MEXICO = 'Mexico';

    // Asian Countries
    case CHINA = 'China';
    case JAPAN = 'Japan';
    case INDIA = 'India';
    case THAILAND = 'Thailand';
    case SINGAPORE = 'Singapore';
    case MALAYSIA = 'Malaysia';
    case INDONESIA = 'Indonesia';
    case PHILIPPINES = 'Philippines';
    case VIETNAM = 'Vietnam';
    case SOUTH_KOREA = 'South Korea';
    case UAE = 'United Arab Emirates';
    case SAUDI_ARABIA = 'Saudi Arabia';
    case QATAR = 'Qatar';
    case ISRAEL = 'Israel';

    // Oceania Countries
    case AUSTRALIA = 'Australia';
    case NEW_ZEALAND = 'New Zealand';
    case FIJI = 'Fiji';

    // South American Countries
    case BRAZIL = 'Brazil';
    case ARGENTINA = 'Argentina';
    case CHILE = 'Chile';
    case PERU = 'Peru';
    case COLOMBIA = 'Colombia';
    case ECUADOR = 'Ecuador';
    case VENEZUELA = 'Venezuela';

    // Others
    case RUSSIA = 'Russia';
    case TURKEY = 'Turkey';

    public function getContinent(): string
    {
        return match ($this) {
            // Africa
            self::TANZANIA, self::KENYA, self::UGANDA, self::RWANDA, self::BURUNDI,
            self::SOUTH_AFRICA, self::NAMIBIA, self::BOTSWANA, self::ZAMBIA, self::ZIMBABWE,
            self::MOZAMBIQUE, self::ETHIOPIA, self::SUDAN, self::EGYPT, self::MOROCCO,
            self::NIGERIA, self::GHANA, self::SENEGAL, self::IVORY_COAST, self::CAMEROON => 'Africa',

            // Europe
            self::UNITED_KINGDOM, self::FRANCE, self::GERMANY, self::ITALY, self::SPAIN,
            self::NETHERLANDS, self::SWITZERLAND, self::BELGIUM, self::AUSTRIA, self::SWEDEN,
            self::NORWAY, self::DENMARK, self::FINLAND, self::PORTUGAL, self::GREECE, self::IRELAND => 'Europe',

            // North America
            self::UNITED_STATES, self::CANADA, self::MEXICO => 'North America',

            // Asia
            self::CHINA, self::JAPAN, self::INDIA, self::THAILAND, self::SINGAPORE,
            self::MALAYSIA, self::INDONESIA, self::PHILIPPINES, self::VIETNAM, self::SOUTH_KOREA,
            self::UAE, self::SAUDI_ARABIA, self::QATAR, self::ISRAEL, self::TURKEY => 'Asia',

            // Oceania
            self::AUSTRALIA, self::NEW_ZEALAND, self::FIJI => 'Oceania',

            // South America
            self::BRAZIL, self::ARGENTINA, self::CHILE, self::PERU, self::COLOMBIA,
            self::ECUADOR, self::VENEZUELA => 'South America',

            // Others
            self::RUSSIA => 'Europe/Asia',
        };
    }
}
