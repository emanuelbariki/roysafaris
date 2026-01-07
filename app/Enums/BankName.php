<?php

namespace App\Enums;

enum BankName: string
{
    case Absa = 'Absa';
    case AccessBank = 'Access Bank';
    case ACB = 'ACB';
    case AmanaBank = 'Amana Bank';
    case AzaniaBank = 'Azania Bank';
    case BOA = 'BOA';
    case BankOfBaroda = 'Bank of Baroda';
    case BankOfIndia = 'Bank of India';
    case ChinaDashengBank = 'China Dasheng Bank';
    case Citibank = 'Citibank';
    case CRDB = 'CRDB';
    case DCB = 'DCB';
    case DTB = 'DTB';
    case Ecobank = 'Ecobank';
    case EquityBank = 'Equity Bank';
    case EximBank = 'Exim Bank';
    case GTBank = 'GTBank';
    case HabibAfricanBank = 'Habib African Bank';
    case IMBank = 'I&M Bank';
    case ICB = 'ICB';
    case KCB = 'KCB';
    case LetshegoBank = 'Letshego Bank';
    case MkomboziBank = 'Mkombozi Bank';
    case MCB = 'MCB';
    case MwangaHakikaBank = 'Mwanga Hakika Bank';
    case NBC = 'NBC';
    case NCBA = 'NCBA';
    case NMB = 'NMB';
    case PBZ = 'PBZ';
    case Stanbic = 'Stanbic';
    case StandardChartered = 'Standard Chartered';
    case TCB = 'TCB';
    case UBA = 'UBA';

    public function getFullName(): string
    {
        return match ($this) {
            self::Absa => 'Absa Bank Tanzania Limited',
            self::AccessBank => 'Access Bank Tanzania Limited',
            self::ACB => 'Akiba Commercial Bank Plc',
            self::AmanaBank => 'Amana Bank Limited',
            self::AzaniaBank => 'Azania Bank Limited',
            self::BOA => 'Bank of Africa Tanzania Limited',
            self::BankOfBaroda => 'Bank of Baroda Tanzania Limited',
            self::BankOfIndia => 'Bank of India Tanzania Limited',
            self::ChinaDashengBank => 'China Dasheng Bank Limited',
            self::Citibank => 'Citibank Tanzania Limited',
            self::CRDB => 'CRDB Bank Plc',
            self::DCB => 'DCB Commercial Bank Plc',
            self::DTB => 'Diamond Trust Bank Tanzania Limited',
            self::Ecobank => 'Ecobank Tanzania Limited',
            self::EquityBank => 'Equity Bank Tanzania Limited',
            self::EximBank => 'Exim Bank Tanzania Limited',
            self::GTBank => 'Guaranty Trust Bank Tanzania Limited',
            self::HabibAfricanBank => 'Habib African Bank Limited',
            self::IMBank => 'I&M Bank Tanzania Limited',
            self::ICB => 'International Commercial Bank Tanzania Limited',
            self::KCB => 'KCB Bank Tanzania Limited',
            self::LetshegoBank => 'Letshego Faidika Bank Tanzania Limited',
            self::MkomboziBank => 'Mkombozi Commercial Bank Plc',
            self::MCB => 'Mwalimu Commercial Bank Plc',
            self::MwangaHakikaBank => 'Mwanga Hakika Bank Limited',
            self::NBC => 'National Bank of Commerce Limited',
            self::NCBA => 'NCBA Bank Tanzania Limited',
            self::NMB => 'NMB Bank Plc',
            self::PBZ => 'People\'s Bank of Zanzibar Limited',
            self::Stanbic => 'Stanbic Bank Tanzania Limited',
            self::StandardChartered => 'Standard Chartered Bank Tanzania Limited',
            self::TCB => 'Tanzania Commercial Bank Plc',
            self::UBA => 'United Bank for Africa Tanzania Limited',
        };
    }
}
