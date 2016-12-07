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
        
        $month = (int) date('n', (int) $date);
        $month = intval($month / TIME_MONTH_IN_QUARTER);
        
        if ($month == 0) {
            $month = 1;
        }
        
        $monthB = $month * TIME_MONTH_IN_QUARTER;
        $monthF = $month * TIME_MONTH_IN_QUARTER + TIME_MONTH_IN_QUARTER + 1;

        $dateB = new \DateTime('01.' . $monthB . '.' . date('Y'));
        $dateF = clone $dateB;
        $dateF->add(new \DateInterval('P'.TIME_MONTH_IN_QUARTER.'M'));
        
        return array('begin' => $dateB->getTimestamp(), 'finish' => $dateF->getTimestamp());
    }
}
