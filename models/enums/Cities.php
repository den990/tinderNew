<?php

namespace app\models\enums;

use yii2mod\enum\helpers\BaseEnum;

class Cities extends BaseEnum
{
    const ABAZA = 0;
    const ABAKAN = 1;
    const ABDULINO = 2;
    const ABZAKOVO = 3;
    const ABINSK = 4;
    const ABRAU_DYURSO = 5;
    const AVDEEVKA = 6;
    const AGIDEL = 7;
    const AGRYZ = 8;
    const ADLER = 9;
    const ADYGEISK = 10;
    const AZNAKAEVO = 11;
    const AZOV = 12;
    const AK_DOVURAK = 13;
    const AKSAI = 14;
    const ALAGIR = 15;
    const ALAPAEVSK = 16;
    const BOGORODSK = 17;
    const BOGOTOL = 18;
    const BOGUTSAR = 19;
    const BODAYBO = 20;
    const BOKSITOGORSK = 21;
    const BOLGAR = 22;
    const BOLOGOE = 23;
    const BOLOTNOYE = 24;
    const BOLOHOVO = 25;
    const BOLHOV = 26;
    const BOLSHOI_KAMEN = 27;
    const BOLSHOI_UTRISH = 28;
    const BOR = 29;
    const BORZYA = 30;
    const BORISOGLEBSK = 31;
    const BOROVICHI = 32;
    const BOROVSK = 33;
    const BORODINO = 34;
    const BRATSK = 35;
    const BRONNITSY = 36;
    const BRYANKA = 37;
    const BRYANSK = 38;
    const BUGULMA = 39;
    const BUGURUSLAN = 40;
    const BUDENNOVSK = 41;
    const BUZULUK = 42;
    const BUINSK = 43;
    const BUI = 44;
    const BUYNACSK = 45;
    const BUTURLINOVKA = 46;
    const VALDAI = 47;
    const VALYKI = 48;
    const VASILYEVKA = 49;
    const VAHRUSHEVO = 50;
    const VELIZH = 51;
    const VELIKIE_LUKI = 52;
    const VELIKIY_NOVGOROD = 53;
    const VELIKIY_USTYUG = 54;
    const VELSK = 55;
    const VENYOV = 56;
    const VERESHCAGINO = 57;
    const VEREYA = 58;
    const VERKHNEURALSK = 59;
    const VERKHNIY_TAGIL = 60;
    const VERKHNIY_UFALEY = 61;
    const VERKHNYA_PYSHMA = 62;
    const VERKHNYA_SALDA = 63;
    const VERKHNYA_TURA = 64;
    const VERKHOTURYE = 65;
    const VERKHOYANSK = 66;
    const VESELOVKA = 67;
    const VESELOGSK = 68;
    const VETLUGA = 69;
    const VIDNOE = 70;
    const VILYUSK = 71;
    const VILYUCHINSK = 72;
    const VITYAZEVO = 73;
    const VIKHOREVKA = 74;
    const VICHUGA = 75;
    const VLADIVOSTOK = 76;
    const VLADIKAVKAZ = 77;
    const VLADIMIR = 78;
    const VOLGOGRAD = 79;
    const VOLGODONSK = 80;
    const VOLGORECHENSK = 81;
    const VOLZHSK = 82;
    const VOLZHSKIY = 83;
    const VOLNOVAHA = 84;
    const VOLOGDA = 85;
    const VOLODARSK = 86;
    const VOLOKOLOMSK = 87;
    const VOLOSOVO = 88;
    const VOLKHOV = 89;
    const VOLCHANSK = 90;
    const VOLNYANSK = 91;
    const VOLSK = 92;
    const VORKUTA = 93;
    const VORONEZH = 94;
    const VORSMA = 95;
    const VOSKRESENSK = 96;
    const VOTKINSK = 97;
    const VSEVOLOZHSK = 98;
    const VUKTYL = 99;
    const VYBORG = 100;
    const VYKSA = 101;
    const VYSOKOVSK = 102;
    const VYSOTSK = 103;
    const VYTEGRA = 104;
    const VYSHNIY_VOLOCHYOK = 105;
    const VYAZEMSKIY = 106;
    const VYAZNIKI = 107;
    const VYAZMA = 108;
    const VYATSKIE_POLYANY = 109;
    const GAVRILOV_POSAD = 110;
    const GAVRILOV_YAM = 111;
    const GAGARIN = 112;
    const GADZHIEVO = 113;
    const GAY = 114;
    const ISHIMBAY = 115;
    const YOSHKAR_OLA = 116;
    const KABARDINKA = 117;
    const KADNIKOV = 118;
    const KAZAN = 119;
    const KALACH = 120;
    const KALACH_NA_DONU = 121;
    const KALACHINSK = 122;
    const KALININGRAD = 123;
    const KALININSK = 124;
    const KALTAN = 125;
    const KALUGA = 126;
    const KALYAZIN = 127;
    const KAMBARKA = 128;
    const KAMENKA = 129;
    const MOSKVA = 130;

    /**
     * @var string message category
     * You can set your own message category for translate the values in the $list property
     * Values in the $list property will be automatically translated in the function `listData()`
     */
    public static $messageCategory = 'app';

    public static function getNumericCode($cityName)
    {
        $cityCode = self::$list[$cityName] ?? null;

        if ($cityCode !== null) {
            $numericCode = self::$codeToValue[$cityCode] ?? null;
            if ($numericCode !== null) {
                return $numericCode;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
    /**
     * @var array
     */
    public static $list = [
        'Абаза' => 'ABAZA',
        'Абакан' => 'ABAKAN',
        'Абдулино' => 'ABDULINO',
        'Абзаково' => 'ABZAKOVO',
        'Абинск' => 'ABINSK',
        'Абрау-Дюрсо' => 'ABRAU_DYURSO',
        'Авдеевка' => 'AVDEEVKA',
        'Агидель' => 'AGIDEL',
        'Агрыз' => 'AGRYZ',
        'Адлер' => 'ADLER',
        'Адыгейск' => 'ADYGEISK',
        'Азнакаево' => 'AZNAKAEVO',
        'Азов' => 'AZOV',
        'Ак-Довурак' => 'AK_DOVURAK',
        'Аксай' => 'AKSAI',
        'Алагир' => 'ALAGIR',
        'Алапаевск' => 'ALAPAEVSK',
        'Богородск' => 'BOGORODSK',
        'Боготол' => 'BOGOTOL',
        'Богучар' => 'BOGUTSAR',
        'Бодайбо' => 'BODAYBO',
        'Бокситогорск' => 'BOKSITOGORSK',
        'Болгар' => 'BOLGAR',
        'Бологое' => 'BOLOGOE',
        'Болотное' => 'BOLOTNOYE',
        'Болохово' => 'BOLOHOVO',
        'Болхов' => 'BOLHOV',
        'Большой Камень' => 'BOLSHOI_KAMEN',
        'Большой Утриш' => 'BOLSHOI_UTRISH',
        'Бор' => 'BOR',
        'Борзя' => 'BORZYA',
        'Борисоглебск' => 'BORISOGLEBSK',
        'Боровичи' => 'BOROVICHI',
        'Боровск' => 'BOROVSK',
        'Бородино' => 'BORODINO',
        'Братск' => 'BRATSK',
        'Бронницы' => 'BRONNITSY',
        'Брянка' => 'BRYANKA',
        'Брянск' => 'BRYANSK',
        'Бугульма' => 'BUGULMA',
        'Бугуруслан' => 'BUGURUSLAN',
        'Будённовск' => 'BUDENNOVSK',
        'Бузулук' => 'BUZULUK',
        'Буинск' => 'BUINSK',
        'Буй' => 'BUI',
        'Буйнакск' => 'BUYNACSK',
        'Бутурлиновка' => 'BUTURLINOVKA',
        'Валдай' => 'VALDAI',
        'Валуйки' => 'VALYKI',
        'Васильевка' => 'VASILYEVKA',
        'Вахрушево' => 'VAHRUSHEVO',
        'Велиж' => 'VELIZH',
        'Великие Луки' => 'VELIKIE_LUKI',
        'Великий Новгород' => 'VELIKIY_NOVGOROD',
        'Великий Устюг' => 'VELIKIY_USTYUG',
        'Вельск' => 'VELSK',
        'Венёв' => 'VENYOV',
        'Верещагино' => 'VERESHCAGINO',
        'Верея' => 'VEREYA',
        'Верхнеуральск' => 'VERKHNEURALSK',
        'Верхний Тагил' => 'VERKHNIY_TAGIL',
        'Верхний Уфалей' => 'VERKHNIY_UFALEY',
        'Верхняя Пышма' => 'VERKHNYA_PYSHMA',
        'Верхняя Салда' => 'VERKHNYA_SALDA',
        'Верхняя Тура' => 'VERKHNYA_TURA',
        'Верхотурье' => 'VERKHOTURYE',
        'Верхоянск' => 'VERKHOYANSK',
        'Веселовка' => 'VESELOVKA',
        'Весьегонск' => 'VESELOGSK',
        'Ветлуга' => 'VETLUGA',
        'Видное' => 'VIDNOE',
        'Вилюйск' => 'VILYUSK',
        'Вилючинск' => 'VILYUCHINSK',
        'Витязево' => 'VITYAZEVO',
        'Вихоревка' => 'VIKHOREVKA',
        'Вичуга' => 'VICHUGA',
        'Владивосток' => 'VLADIVOSTOK',
        'Владикавказ' => 'VLADIKAVKAZ',
        'Владимир' => 'VLADIMIR',
        'Волгоград' => 'VOLGOGRAD',
        'Волгодонск' => 'VOLGODONSK',
        'Волгореченск' => 'VOLGORECHENSK',
        'Волжск' => 'VOLZHSK',
        'Волжский' => 'VOLZHSKIY',
        'Волноваха' => 'VOLNOVAHA',
        'Вологда' => 'VOLOGDA',
        'Володарск' => 'VOLODARSK',
        'Волоколамск' => 'VOLOKOLOMSK',
        'Волосово' => 'VOLOSOVO',
        'Волхов' => 'VOLKHOV',
        'Волчанск' => 'VOLCHANSK',
        'Вольнянск' => 'VOLNYANSK',
        'Вольск' => 'VOLSK',
        'Воркута' => 'VORKUTA',
        'Воронеж' => 'VORONEZH',
        'Ворсма' => 'VORSMA',
        'Воскресенск' => 'VOSKRESENSK',
        'Воткинск' => 'VOTKINSK',
        'Всеволожск' => 'VSEVOLOZHSK',
        'Вуктыл' => 'VUKTYL',
        'Выборг' => 'VYBORG',
        'Выкса' => 'VYKSA',
        'Высоковск' => 'VYSOKOVSK',
        'Высоцк' => 'VYSOTSK',
        'Вытегра' => 'VYTEGRA',
        'Вышний Волочёк' => 'VYSHNIY_VOLOCHYOK',
        'Вяземский' => 'VYAZEMSKIY',
        'Вязники' => 'VYAZNIKI',
        'Вязьма' => 'VYAZMA',
        'Вятские Поляны' => 'VYATSKIE_POLYANY',
        'Гаврилов Посад' => 'GAVRILOV_POSAD',
        'Гаврилов-Ям' => 'GAVRILOV_YAM',
        'Гагарин' => 'GAGARIN',
        'Гаджиево' => 'GADZHIEVO',
        'Гай' => 'GAY',
        'Ишимбай' => 'ISHIMBAY',
        'Йошкар-Ола' => 'YOSHKAR_OLA',
        'Кабардинка' => 'KABARDINKA',
        'Кадников' => 'KADNIKOV',
        'Казань' => 'KAZAN',
        'Калач' => 'KALACH',
        'Калач-на-Дону' => 'KALACH_NA_DONU',
        'Калачинск' => 'KALACHINSK',
        'Калининград' => 'KALININGRAD',
        'Калининск' => 'KALININSK',
        'Калтан' => 'KALTAN',
        'Калуга' => 'KALUGA',
        'Калязин' => 'KALYAZIN',
        'Камбарка' => 'KAMBARKA',
        'Каменка' => 'KAMENKA',
        'Москва' => 'MOSKVA',
    ];
    public static $codeToValue = [
        'ABAZA' => 1,
        'ABAKAN' => 2,
        'ABDULINO' => 3,
        'ABZAKOVO' => 4,
        'ABINSK' => 5,
        'ABRAU_DYURSO' => 6,
        'AVDEEVKA' => 7,
        'AGIDEL' => 8,
        'AGRYZ' => 9,
        'ADLER' => 10,
        'ADYGEISK' => 11,
        'AZNAKAEVO' => 12,
        'AZOV' => 13,
        'AK_DOVURAK' => 14,
        'AKSAI' => 15,
        'ALAGIR' => 16,
        'ALAPAEVSK' => 17,
        'BOGORODSK' => 18,
        'BOGOTOL' => 19,
        'BOGUTSAR' => 20,
        'BODAYBO' => 21,
        'BOKSITOGORSK' => 22,
        'BOLGAR' => 23,
        'BOLOGOE' => 24,
        'BOLOTNOYE' => 25,
        'BOLOHOVO' => 26,
        'BOLHOV' => 27,
        'BOLSHOI_KAMEN' => 28,
        'BOLSHOI_UTRISH' => 29,
        'BOR' => 30,
        'BORZYA' => 31,
        'BORISOGLEBSK' => 32,
        'BOROVICHI' => 33,
        'BOROVSK' => 34,
        'BORODINO' => 35,
        'BRATSK' => 36,
        'BRONNITSY' => 37,
        'BRYANKA' => 38,
        'BRYANSK' => 39,
        'BUGULMA' => 40,
        'BUGURUSLAN' => 41,
        'BUDENNOVSK' => 42,
        'BUZULUK' => 43,
        'BUINSK' => 44,
        'BUI' => 45,
        'BUYNACSK' => 46,
        'BUTURLINOVKA' => 47,
        'VALDAI' => 48,
        'VALYKI' => 49,
        'VASILYEVKA' => 50,
        'VAHRUSHEVO' => 51,
        'VELIZH' => 52,
        'VELIKIE_LUKI' => 53,
        'VELIKIY_NOVGOROD' => 54,
        'VELIKIY_USTYUG' => 55,
        'VELSK' => 56,
        'VENYOV' => 57,
        'VERESHCAGINO' => 58,
        'VEREYA' => 59,
        'VERKHNEURALSK' => 60,
        'VERKHNIY_TAGIL' => 61,
        'VERKHNIY_UFALEY' => 62,
        'VERKHNYA_PYSHMA' => 63,
        'VERKHNYA_SALDA' => 64,
        'VERKHNYA_TURA' => 65,
        'VERKHOTURYE' => 66,
        'VERKHOYANSK' => 67,
        'VESELOVKA' => 68,
        'VESELOGSK' => 69,
        'VETLUGA' => 70,
        'VIDNOE' => 71,
        'VILYUSK' => 72,
        'VILYUCHINSK' => 73,
        'VITYAZEVO' => 74,
        'VIKHOREVKA' => 75,
        'VICHIGA' => 76,
        'VLADIVOSTOK' => 77,
        'VLADIKAVKAZ' => 78,
        'VLADIMIR' => 79,
        'VOLGOGRAD' => 80,
        'VOLGODONSK' => 81,
        'VOLGORECHENSK' => 82,
        'VOLZHSK' => 83,
        'VOLZHSKIY' => 84,
        'VOLNOVAHA' => 85,
        'VOLOGDA' => 86,
        'VOLODARSK' => 87,
        'VOLOKOLOMSK' => 88,
        'VOLOSOVO' => 89,
        'VOLKHOV' => 90,
        'VOLCHANSK' => 91,
        'VOLNYANSK' => 92,
        'VOLSK' => 93,
        'VORKUTA' => 94,
        'VORONEZH' => 95,
        'VORSMA' => 96,
        'VOSKRESENSK' => 97,
        'VOTKINSK' => 98,
        'VSEVOLOZHSK' => 99,
        'VUKTYL' => 100,
        'VYBORG' => 101,
        'VYKSA' => 102,
        'VYSOKOVSK' => 103,
        'VYSOTSK' => 104,
        'VYTEGRA' => 105,
        'VYSHNIY_VOLOCHYOK' => 106,
        'VYAZEMSKIY' => 107,
        'VYAZNIKI' => 108,
        'VYAZMA' => 109,
        'VYATSKIE_POLYANY' => 110,
        'GAVRILOV_POSAD' => 111,
        'GAVRILOV_YAM' => 112,
        'GAGARIN' => 113,
        'GADZHIEVO' => 114,
        'GAY' => 115,
        'ISHIMBAY' => 116,
        'YOSHKAR_OLA' => 117,
        'KABARDINKA' => 118,
        'KADNIKOV' => 119,
        'KAZAN' => 120,
        'KALACH' => 121,
        'KALACH_NA_DONU' => 122,
        'KALACHINSK' => 123,
        'KALININGRAD' => 124,
        'KALININSK' => 125,
        'KALTAN' => 126,
        'KALUGA' => 127,
        'KALYAZIN' => 128,
        'KAMBARKA' => 129,
        'KAMENKA' => 130,
        'MOSKVA' => 131,
    ];


}