<?php
 
namespace Glyf\Oscar\Events;

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;

IncludeModuleLangFile(__FILE__);


/**
 * Обработчик событий главного модуля.
 */
class EventPicture
{
    protected static $vars = array();
    
    
    /**
     * Обновление (до).
     */
    public static function onBeforeUpdate(\Bitrix\Main\Entity\Event $event)
    {
        $data = $event->getParameters();
        
        // Объект.
        $picture = new \Glyf\Oscar\Picture($data['id'][\Glyf\Oscar\Picture::FIELD_ID]);
        
        // Модерация до обновления.
        self::$vars['MODERATE'] = $picture->isModerate();
    }
    
    
    /**
     * Обновление.
     */
    public static function onAfterUpdate(\Bitrix\Main\Entity\Event $event)
    {
        $data = $event->getParameters();
        
        // Модерация после обновления.
        $moderate = $data['fields'][\Glyf\Oscar\Picture::FIELD_MODERATE];
        
        if (self::$vars['MODERATE'] != $moderate && $moderate) {
            $picture = new \Glyf\Oscar\Picture($data['id'][\Glyf\Oscar\Picture::FIELD_ID], $data);
            $picture->update(array(
                \Glyf\Oscar\Picture::FIELD_MODERATE_TIME => new \Bitrix\Main\Type\DateTime()
            ));
        }
        unset(self::$vars['MODERATE']);
    }
}