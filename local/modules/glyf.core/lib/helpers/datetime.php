<?php

namespace Glyf\Core\Helpers;

use Bitrix\Main\Localization\Loc;

IncludeModuleLangFile(__FILE__);


/**
 * Вспомогательный класс для работы с текстом.
 */
class DateTime
{	



    /** 
     * Получение квартала по текущей дате.
     */
    public static function getQuarter($date = null)
    {
        if (empty($date)) {
            $date = time();
        }
        
        // Дельта для верного округления.
        $delta = 0.1;
        
        $quarter = (int) date('n', (int) $date);
        $quarter = ceil($quarter / TIME_MONTH_IN_QUARTER - $delta);
        
        if ($quarter == 0) {
            $quarter = 1;
        }
        
        $month = $quarter * TIME_MONTH_IN_QUARTER - (TIME_MONTH_IN_QUARTER - 1);
        
        $dateB = new \DateTime('01.' . $month . '.' . date('Y'));
        $dateF = new \DateTime('01.' . $month . '.' . date('Y'));
        
        $dateF->modify('+' . TIME_MONTH_IN_QUARTER . ' month')->modify('-1 day');
        
        
        return array('begin' => $dateB->getTimestamp(), 'finish' => $dateF->getTimestamp());
    }
}
