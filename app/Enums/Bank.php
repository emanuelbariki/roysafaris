<?php

namespace App\Enums;

enum Bank: string
{
    // Tanzanian Banks
    case ABSA = 'Absa Bank Tanzania Limited';
    case ACCESS_BANK = 'Access Bank Tanzania Limited';
    case ACB = 'Akiba Commercial Bank Plc';
    case AMANA = 'Amana Bank Limited';
    case AZANIA = 'Azania Bank Limited';
    case BOA = 'Bank of Africa Tanzania Limited';
    case BANK_OF_BARODA = 'Bank of Baroda Tanzania Limited';
    case BANK_OF_INDIA = 'Bank of India Tanzania Limited';
    case CHINA_DASHENG = 'China Dasheng Bank Limited';
    case CITIBANK = 'Citibank Tanzania Limited';
    case CRDB = 'CRDB Bank Plc';
    case DCB = 'DCB Commercial Bank Plc';
    case DTB = 'Diamond Trust Bank Tanzania Limited';
    case ECOBANK = 'Ecobank Tanzania Limited';
    case EQUITY = 'Equity Bank Tanzania Limited';
    case EXIM = 'Exim Bank Tanzania Limited';
    case GTBANK = 'Guaranty Trust Bank Tanzania Limited';
    case HABIB_AFRICAN = 'Habib African Bank Limited';
    case IMB = 'I&M Bank Tanzania Limited';
    case ICB = 'International Commercial Bank Tanzania Limited';
    case KCB = 'KCB Bank Tanzania Limited';
    case LETSHEGO = 'Letshego Faidika Bank Tanzania Limited';
    case MKOMBOZI = 'Mkombozi Commercial Bank Plc';
    case MCB = 'Mwalimu Commercial Bank Plc';
    case MWANGA_HAKIKA = 'Mwanga Hakika Bank Limited';
    case NBC = 'National Bank of Commerce Limited';
    case NCBA = 'NCBA Bank Tanzania Limited';
    case NMB = 'NMB Bank Plc';
    case PBZ = 'People\'s Bank of Zanzibar Limited';
    case STANBIC = 'Stanbic Bank Tanzania Limited';
    case STANDARD_CHARTERED = 'Standard Chartered Bank Tanzania Limited';
    case TCB = 'Tanzania Commercial Bank Plc';
    case UBA = 'United Bank for Africa Tanzania Limited';

    public function getShortName(): string
    {
        return match ($this) {
            self::ABSA => 'Absa',
            self::ACCESS_BANK => 'Access Bank',
            self::ACB => 'ACB',
            self::AMANA => 'Amana Bank',
            self::AZANIA => 'Azania Bank',
            self::BOA => 'BOA',
            self::BANK_OF_BARODA => 'Bank of Baroda',
            self::BANK_OF_INDIA => 'Bank of India',
            self::CHINA_DASHENG => 'China Dasheng Bank',
            self::CITIBANK => 'Citibank',
            self::CRDB => 'CRDB',
            self::DCB => 'DCB',
            self::DTB => 'DTB',
            self::ECOBANK => 'Ecobank',
            self::EQUITY => 'Equity Bank',
            self::EXIM => 'Exim Bank',
            self::GTBANK => 'GTBank',
            self::HABIB_AFRICAN => 'Habib African Bank',
            self::IMB => 'I&M Bank',
            self::ICB => 'ICB',
            self::KCB => 'KCB',
            self::LETSHEGO => 'Letshego Bank',
            self::MKOMBOZI => 'Mkombozi Bank',
            self::MCB => 'MCB',
            self::MWANGA_HAKIKA => 'Mwanga Hakika Bank',
            self::NBC => 'NBC',
            self::NCBA => 'NCBA',
            self::NMB => 'NMB',
            self::PBZ => 'PBZ',
            self::STANBIC => 'Stanbic',
            self::STANDARD_CHARTERED => 'Standard Chartered',
            self::TCB => 'TCB',
            self::UBA => 'UBA',
        };
    }

    public static function getAllBanks(): array
    {
        return array_map(fn($bank) => [
            'full_name' => $bank->value,
            'short_name' => $bank->getShortName(),
        ], self::cases());
    }

    public static function groupedByName(): array
    {
        $banks = self::cases();
        $grouped = [];

        foreach ($banks as $bank) {
            $firstLetter = strtoupper($bank->getShortName()[0]);
            $grouped[$firstLetter][] = [
                'full_name' => $bank->value,
                'short_name' => $bank->getShortName(),
                'value' => $bank->value,
            ];
        }

        ksort($grouped);
        return $grouped;
    }
}
