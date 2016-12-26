<?php

namespace Glyf\Oscar;

use Glyf\Oscar\Tariff;
use Glyf\Oscar\UserTariff;
use Glyf\Oscar\User;
use Glyf\Oscar\Order;

/**
 * Заказанные тарифы.
 */
class OrderTariff extends \Glyf\Core\System\HLBlockModel
{
    const FIELD_ID           = 'ID';
    const FIELD_USER_ID      = 'UF_USER_ID';
    const FIELD_ORDER_ID     = 'UF_ORDER_ID';
    const FIELD_TARIFF_ID    = 'UF_TARIFF_ID';
    const FIELD_TIME_BEGIN   = 'UF_TIME_BEGIN';
    const FIELD_TIME_FINISH  = 'UF_TIME_FINISH';
    const FIELD_ACTIVE       = 'UF_ACTIVE';
    
    
    static protected $hlblockID = HLBLOCK_ORDER_TARIFFS_ID;
    
    
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
    
    
    public function getTariff()
    {
        return (new Tariff($this->getTariffID()));
    }
    
    
    public function getOrder()
    {
        return (new getOrder($this->getOrderID()));
    }
    
    
    /**
     * Активация тарифа.
     */
    public function activate($intime = true)
    {
        $data = array(self::FIELD_ACTIVE => true);
        
        if ($intime) {
            $tariff = self::prev($this->getUserID(), $this->getID());
            
            if (is_object($tariff) && $tariff->getID() > 0) {
                $time = $tariff->getTimeFinish();
                
                if (is_object($time)) {
                    $timeT = $time->getTimestamp();
                } else {
                    $timeT = time();
                }
                
                if ($timeT < time()) {
                    $timeT = time();
                }
                
                $timeB = strtotime(date('d.m.Y', $timeT) . '+1 day');
                $timeF = strtotime(date('d.m.Y', $timeB) . '+1 month');

                $dateB = date('d.m.Y', $timeB);
                $dateF = date('d.m.Y', $timeF);
            } else {
                $dateB = date('d.m.Y');
                $dateF = date('d.m.Y', strtotime('+1 month'));
            }
            
            $data[self::FIELD_TIME_BEGIN]  = $dateB;
            $data[self::FIELD_TIME_FINISH] = $dateF;
        }
        $this->update($data);
    }
    
    
    /**
     * Деактивация тарифа.
     */
    public function deactivate()
    {
        $this->update(array(self::FIELD_ACTIVE => false));
    }
    
    
    /**
     * Получение текущего активного тарифа.
     */
    public static function current($uid = null)
    {
        $user = new \Glyf\Oscar\User($uid);
        
        $tariffs = self::getList(array(
            'limit'  => 1,
            'filter' => array(
                self::FIELD_ACTIVE             => true,
                self::FIELD_USER_ID            => $user->getID(),
                '<=' . self::FIELD_TIME_BEGIN  => date('d.m.Y'),
                '>'  . self::FIELD_TIME_FINISH => date('d.m.Y'),
            )
        ));
        
        if (!empty($tariffs)) {
            return reset($tariffs);
        }
        return null;
    }
    
    
    /**
     * Получение текущего активного тарифа.
     */
    public static function last($uid = null)
    {
        $user = new \Glyf\Oscar\User($uid);
        
        $tariffs = self::getList(array(
            'limit'  => 1,
            'order'  => array(self::FIELD_TIME_FINISH => 'DESC'),
            'filter' => array(self::FIELD_USER_ID => $user->getID())
        ));
        
        if (!empty($tariffs)) {
            return reset($tariffs);
        }
        return null;
    }
    
    
     /**
     * Получение текущего активного тарифа.
     */
    public static function prev($uid = null, $tid = null)
    {
        $tariffs = self::getList(array(
            'limit'  => 1,
            'order'  => array(self::FIELD_TIME_FINISH => 'DESC'),
            'filter' => array(
                self::FIELD_USER_ID  => intval($uid),
                '!' . self::FIELD_ID => intval($tid),
            )
        ));
        
        if (!empty($tariffs)) {
            return reset($tariffs);
        }
        return null;
    }
    
    
    /**
     * Поиск купленного тарифа по ID заказа
     */
    public static function getByOrderID($oid)
    {
        $tariffs = self::getList(array(
            'limit'  => 1,
            'filter' => array(
                self::FIELD_ORDER_ID => intval($oid),
            )
        ));
        
        if (!empty($tariffs)) {
            return reset($tariffs);
        }
        return null;
    }
    
    
    /**
     * Запись о покупке тарифа.
     */
    public static function buy($uid, $oid, $tid)
    {
        $data = array(
            self::FIELD_USER_ID     => intval($uid),
            self::FIELD_ORDER_ID    => intval($oid),
            self::FIELD_TARIFF_ID   => intval($tid),
            self::FIELD_TIME_BEGIN  => null,
            self::FIELD_TIME_FINISH => null,
            self::FIELD_ACTIVE      => false,
        );
        
        $item = new self();
        $item->add($data);
    }
}