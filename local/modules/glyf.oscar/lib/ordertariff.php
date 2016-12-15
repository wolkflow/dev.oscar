<?php

namespace Glyf\Oscar;

use Glyf\Oscar\Tariff;
use Glyf\Oscar\UserTariff;
use Glyf\Oscar\User;

/**
 * Заказанные тарифы.
 */
class OrderTariff extends \Glyf\Core\System\IBlockModel
{
    const FIELD_ID           = 'ID';
    const FIELD_USER_ID      = 'UF_USER_ID';
    const FIELD_ORDER_ID     = 'UF_ORDER_ID';
    const FIELD_TARIFF_ID    = 'UF_TARIFF_ID';
    const FIELD_TIME_BEGIN   = 'UF_TIME_BEGIN';
    const FIELD_TIME_FINISH  = 'UF_TIME_FINISH';
    const FIELD_ACTIVE       = 'UF_ACTIVE';
    
    
    
    public function getUserID()
    {
        return $this->get(self::FIELD_USER_ID);
    }
    
    
    public function getOrderID()
    {
        return $this->get(self::FIELD_ORDER_ID);
    }
    
    
    public function getTariffID()
    {
        return $this->get(self::FIELD_TARIFF_ID);
    }
    
    
    public function getTimeBegin()
    {
        return $this->get(self::FIELD_TIME_BEGIN);
    }
    
    
    public function getTimeFinish()
    {
        return $this->get(self::FIELD_TIME_FINISH);
    }
    
    
    public function getActive()
    {
        return $this->get(self::FIELD_ACTIVE);
    }
    
    
    public function getUser()
    {
        return (new User($this->getUserID()));
    }
    
    
    public function active()
    {
        $this->update(array(self::FIELD_ACTIVE => true));
    }
    
    
    public function deactive()
    {
        $this->update(array(self::FIELD_ACTIVE => false));
    }
    
    
    /**
     * Получение текущего активного тарифа.
     */
    public static function getCurrent()
    {
        $tariffs = self::getList(array(
            'limit'  => 1,
            'filter' => array()
        ));
        
        if (!empty($tariffs)) {
            return reset($tariffs);
        }
        return null;
    }
}