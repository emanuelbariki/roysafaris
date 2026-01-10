<?php

namespace App\Enums;

enum Nationality: string
{
    // African Countries
    case Tanzania = 'TZ';
    case Kenya = 'KE';
    case Uganda = 'UG';
    case Rwanda = 'RW';
    case Burundi = 'BI';
    case SouthAfrica = 'ZA';
    case Nigeria = 'NG';
    case Ghana = 'GH';
    case Egypt = 'EG';
    case Morocco = 'MA';
    case Ethiopia = 'ET';
    case Zambia = 'ZM';
    case Zimbabwe = 'ZW';
    case Botswana = 'BW';
    case Namibia = 'NA';
    case Mozambique = 'MZ';
    case Malawi = 'MW';
    case Sudan = 'SD';
    case Libya = 'LY';
    case Tunisia = 'TN';
    case Algeria = 'DZ';

    // European Countries
    case UnitedKingdom = 'GB';
    case Germany = 'DE';
    case France = 'FR';
    case Italy = 'IT';
    case Spain = 'ES';
    case Netherlands = 'NL';
    case Switzerland = 'CH';
    case Belgium = 'BE';
    case Austria = 'AT';
    case Sweden = 'SE';
    case Norway = 'NO';
    case Denmark = 'DK';
    case Finland = 'FI';
    case Portugal = 'PT';
    case Greece = 'GR';
    case Ireland = 'IE';
    case Poland = 'PL';
    case CzechRepublic = 'CZ';
    case Hungary = 'HU';
    case Russia = 'RU';

    // Asian Countries
    case China = 'CN';
    case Japan = 'JP';
    case India = 'IN';
    case SouthKorea = 'KR';
    case Thailand = 'TH';
    case Singapore = 'SG';
    case Malaysia = 'MY';
    case Indonesia = 'ID';
    case Philippines = 'PH';
    case Vietnam = 'VN';
    case HongKong = 'HK';
    case Taiwan = 'TW';
    case Pakistan = 'PK';
    case Bangladesh = 'BD';
    case SriLanka = 'LK';
    case Nepal = 'NP';
    case Myanmar = 'MM';
    case Cambodia = 'KH';
    case Laos = 'LA';
    case Brunei = 'BN';
    case Macau = 'MO';

    // Middle Eastern Countries
    case UnitedArabEmirates = 'AE';
    case SaudiArabia = 'SA';
    case Qatar = 'QA';
    case Kuwait = 'KW';
    case Bahrain = 'BH';
    case Oman = 'OM';
    case Jordan = 'JO';
    case Lebanon = 'LB';
    case Israel = 'IL';
    case Turkey = 'TR';
    case Iran = 'IR';
    case Iraq = 'IQ';
    case Syria = 'SY';
    case Yemen = 'YE';

    // North American Countries
    case UnitedStates = 'US';
    case Canada = 'CA';
    case Mexico = 'MX';

    // South American Countries
    case Brazil = 'BR';
    case Argentina = 'AR';
    case Chile = 'CL';
    case Colombia = 'CO';
    case Peru = 'PE';
    case Venezuela = 'VE';
    case Ecuador = 'EC';
    case Bolivia = 'BO';
    case Paraguay = 'PY';
    case Uruguay = 'UY';
    case Guyana = 'GY';
    case Suriname = 'SR';

    // Oceania Countries
    case Australia = 'AU';
    case NewZealand = 'NZ';
    case Fiji = 'FJ';
    case PapuaNewGuinea = 'PG';
    case SolomonIslands = 'SB';
    case Vanuatu = 'VU';
    case Samoa = 'WS';
    case Tonga = 'TO';

    public function getName(): string
    {
        return match ($this) {
            self::Tanzania => 'Tanzania',
            self::Kenya => 'Kenya',
            self::Uganda => 'Uganda',
            self::Rwanda => 'Rwanda',
            self::Burundi => 'Burundi',
            self::SouthAfrica => 'South Africa',
            self::Nigeria => 'Nigeria',
            self::Ghana => 'Ghana',
            self::Egypt => 'Egypt',
            self::Morocco => 'Morocco',
            self::Ethiopia => 'Ethiopia',
            self::Zambia => 'Zambia',
            self::Zimbabwe => 'Zimbabwe',
            self::Botswana => 'Botswana',
            self::Namibia => 'Namibia',
            self::Mozambique => 'Mozambique',
            self::Malawi => 'Malawi',
            self::Sudan => 'Sudan',
            self::Libya => 'Libya',
            self::Tunisia => 'Tunisia',
            self::Algeria => 'Algeria',
            self::UnitedKingdom => 'United Kingdom',
            self::Germany => 'Germany',
            self::France => 'France',
            self::Italy => 'Italy',
            self::Spain => 'Spain',
            self::Netherlands => 'Netherlands',
            self::Switzerland => 'Switzerland',
            self::Belgium => 'Belgium',
            self::Austria => 'Austria',
            self::Sweden => 'Sweden',
            self::Norway => 'Norway',
            self::Denmark => 'Denmark',
            self::Finland => 'Finland',
            self::Portugal => 'Portugal',
            self::Greece => 'Greece',
            self::Ireland => 'Ireland',
            self::Poland => 'Poland',
            self::CzechRepublic => 'Czech Republic',
            self::Hungary => 'Hungary',
            self::Russia => 'Russia',
            self::China => 'China',
            self::Japan => 'Japan',
            self::India => 'India',
            self::SouthKorea => 'South Korea',
            self::Thailand => 'Thailand',
            self::Singapore => 'Singapore',
            self::Malaysia => 'Malaysia',
            self::Indonesia => 'Indonesia',
            self::Philippines => 'Philippines',
            self::Vietnam => 'Vietnam',
            self::HongKong => 'Hong Kong',
            self::Taiwan => 'Taiwan',
            self::Pakistan => 'Pakistan',
            self::Bangladesh => 'Bangladesh',
            self::SriLanka => 'Sri Lanka',
            self::Nepal => 'Nepal',
            self::Myanmar => 'Myanmar',
            self::Cambodia => 'Cambodia',
            self::Laos => 'Laos',
            self::Brunei => 'Brunei',
            self::Macau => 'Macau',
            self::UnitedArabEmirates => 'United Arab Emirates',
            self::SaudiArabia => 'Saudi Arabia',
            self::Qatar => 'Qatar',
            self::Kuwait => 'Kuwait',
            self::Bahrain => 'Bahrain',
            self::Oman => 'Oman',
            self::Jordan => 'Jordan',
            self::Lebanon => 'Lebanon',
            self::Israel => 'Israel',
            self::Turkey => 'Turkey',
            self::Iran => 'Iran',
            self::Iraq => 'Iraq',
            self::Syria => 'Syria',
            self::Yemen => 'Yemen',
            self::UnitedStates => 'United States',
            self::Canada => 'Canada',
            self::Mexico => 'Mexico',
            self::Brazil => 'Brazil',
            self::Argentina => 'Argentina',
            self::Chile => 'Chile',
            self::Colombia => 'Colombia',
            self::Peru => 'Peru',
            self::Venezuela => 'Venezuela',
            self::Ecuador => 'Ecuador',
            self::Bolivia => 'Bolivia',
            self::Paraguay => 'Paraguay',
            self::Uruguay => 'Uruguay',
            self::Guyana => 'Guyana',
            self::Suriname => 'Suriname',
            self::Australia => 'Australia',
            self::NewZealand => 'New Zealand',
            self::Fiji => 'Fiji',
            self::PapuaNewGuinea => 'Papua New Guinea',
            self::SolomonIslands => 'Solomon Islands',
            self::Vanuatu => 'Vanuatu',
            self::Samoa => 'Samoa',
            self::Tonga => 'Tonga',
        };
    }

    /**
     * Get all nationalities grouped by region
     */
    public static function groupedByRegion(): array
    {
        return [
            'Africa' => [
                self::Tanzania, self::Kenya, self::Uganda, self::Rwanda, self::Burundi,
                self::SouthAfrica, self::Nigeria, self::Ghana, self::Egypt, self::Morocco,
                self::Ethiopia, self::Zambia, self::Zimbabwe, self::Botswana, self::Namibia,
                self::Mozambique, self::Malawi, self::Sudan, self::Libya, self::Tunisia, self::Algeria,
            ],
            'Europe' => [
                self::UnitedKingdom, self::Germany, self::France, self::Italy, self::Spain,
                self::Netherlands, self::Switzerland, self::Belgium, self::Austria, self::Sweden,
                self::Norway, self::Denmark, self::Finland, self::Portugal, self::Greece,
                self::Ireland, self::Poland, self::CzechRepublic, self::Hungary, self::Russia,
            ],
            'Asia' => [
                self::China, self::Japan, self::India, self::SouthKorea, self::Thailand,
                self::Singapore, self::Malaysia, self::Indonesia, self::Philippines, self::Vietnam,
                self::HongKong, self::Taiwan, self::Pakistan, self::Bangladesh, self::SriLanka,
                self::Nepal, self::Myanmar, self::Cambodia, self::Laos, self::Brunei, self::Macau,
            ],
            'Middle East' => [
                self::UnitedArabEmirates, self::SaudiArabia, self::Qatar, self::Kuwait,
                self::Bahrain, self::Oman, self::Jordan, self::Lebanon, self::Israel,
                self::Turkey, self::Iran, self::Iraq, self::Syria, self::Yemen,
            ],
            'North America' => [
                self::UnitedStates, self::Canada, self::Mexico,
            ],
            'South America' => [
                self::Brazil, self::Argentina, self::Chile, self::Colombia, self::Peru,
                self::Venezuela, self::Ecuador, self::Bolivia, self::Paraguay, self::Uruguay,
                self::Guyana, self::Suriname,
            ],
            'Oceania' => [
                self::Australia, self::NewZealand, self::Fiji, self::PapuaNewGuinea,
                self::SolomonIslands, self::Vanuatu, self::Samoa, self::Tonga,
            ],
        ];
    }
}
