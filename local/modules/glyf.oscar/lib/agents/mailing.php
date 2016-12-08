<?php

namespace Glyf\Oscar\Agents;

use Bitrix\Main\Type\DateTime;
use Glyf\Oscar\Subscribe;

class Mailing
{
    public static function run()
	{
		self::mail();
		
		return (__METHOD__.'();');
	}
    
    
    /**
     * Отправка рассылок.
     */
    public function mail()
    {
        // Свойства HL-блока.
        $props = \Glyf\Core\Helpers\HLBlock::getProps(HLBLOCK_SUBSCRIBES_ID, 'FIELD_NAME', 'XML_ID', false);
        
        $time_week  = strtotime('-1 week');
        $time_month = strtotime('-1 month');
        $time_quart = strtotime('-3 months');
        
        // Список рассылок.
        $subscibes = Subscribe::getList(array(
            'filter' => array(
                array(
                    'LOGIC' => 'OR',
                    array(
                        Subscribe::FIELD_PERIOD  => $props[Subscribe::FIELD_PERIOD]['ENUMS'][Subscribe::PERIOD_WEEKLY]['ID'],
                        '>' . Subscribe::FIELD_LAST_TIME => DateTime::createFromTimestamp($time_week)
                    ),
                    array(
                        Subscribe::FIELD_PERIOD  => $props[Subscribe::FIELD_PERIOD]['ENUMS'][Subscribe::PERIOD_MONTHLY]['ID'],
                        '>' . Subscribe::FIELD_LAST_TIME => DateTime::createFromTimestamp($time_month)
                    ),
                    array(
                        Subscribe::FIELD_PERIOD  => $props[Subscribe::FIELD_PERIOD]['ENUMS'][Subscribe::PERIOD_QUARTLY]['ID'],
                        '>' . Subscribe::FIELD_LAST_TIME => DateTime::createFromTimestamp($time_quart)
                    ),
                )
            )
        ));
        
        
        // Генерация и отправка рассылок.
        foreach ($subscibes as $subscribe) {
            
            // HTML.
            $html = $this->make($subscribe);
            
            // Пользователь.
            $user = new \Glyf\Oscar\User($subscibe->getUserID());
             
            // Отправка письма.
            \Bitrix\Main\Mail\Event::send(array( 
                'EVENT_NAME' => 'GL_SUBSCRIBE', 
                'LID'        => SITE_DEFAULT, 
                'C_FIELDS'   => array(
                    'EMAIL' => $user->getEmail(),
                    'HTML'  => $html,
                ), 
            ));
            
            // Изменение времени последней отправки.
            $subscribe->retime();
        }
    }
    
    
    /**
     * Создание письма.
     */
    public function make(Subscribe $subscribe)
    {
        ob_start();
        
        $GLOBALS['APPLICATION']->IncludeComponent(
            'glyf:mail.subscribe', 
            'subscribe', 
            array('SID' => $subscribe->getID())
        );
        
        $html = ob_get_clean();
        
        return $html;
    }
    
}