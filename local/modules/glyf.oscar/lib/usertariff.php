<?php

namespace Glyf\Oscar;

use Glyf\Oscar\Picture;
use Glyf\Oscar\Tariff;
use Glyf\Oscar\OrderTariff;
use Glyf\Oscar\IPAddress;
use Glyf\Oscar\Statistic\Download;


class UserTariff extends \Glyf\Core\System\IBlockModel
{
    protected $uid         = null;
    protected $time        = null;
    protected $tariff      = null;
    protected $ordertariff = null;
    protected $downloads   = null;
    
    
    public function __construct($uid)
    {
        $this->uid    = (int) $uid;
        //$this->time   = (int) $time;
        //$this->tariff = $tariff;
    }
    
    
    /**
     * Получение ID пользователя.
     */
    public function getUserID()
    {
        return $this->uid;
    }
    
    
    /**
     * Получение времени покупки.
     */
    public function getTime()
    {
        return $this->time;
    }
    
    
    /**
     * Получение тарифа.
     */
    public function getTariff()
    {
        if (empty($this->tariff)) {
            $ordertariff = $this->getOrderTariff();
            if (!empty($ordertariff)) {
                $this->tariff = $ordertariff->getTariff();
            }
        }
        return $this->tariff;
    }
    
    
    /**
     * Получение срок истечение тарифа.
     */
    public function getExpire()
    {
        $ordertariff = $this->getOrderTariff();
            
        if (empty($ordertariff)) {
            return 0;
        }
        return ($ordertariff->getTimeFinish()->getTimestamp());
    }
    
    
    /**
     * Получение активного тарифа.
     */
    public function getOrderTariff()
    {
        if (empty($this->ordertariff)) {
            $this->ordertariff = OrderTariff::current();
        }
        return $this->ordertariff;
    }
    
    
    /**
     * Проверка срока действия тарифа.
     */
    public function isExpire()
    {
        if ($this->getExpire() <= time()) {
            return true;
        }
        return false;
    }
    
    
    /**
     * Получение количества скачиваний.
     */
    public function getDownloadsCount()
    {
        $result = Download::getList(array(
            'filter' => array(Download::FIELD_USER_ID => $this->getUserID(), Download::FIELD_BUYED => false)
        ), false);
        
        $count = (int) $result->getSelectedRowsCount();
        
        return $count;
    }
    
    
    /**
     * Получение количества скачиваний по тарифу.
     */
    public function getDownloadsCountInTariff()
    {
        if (is_null($this->download)) {
            $ordertariff = $this->getOrderTariff();
            
            if (empty($ordertariff)) {
                return 0;
            }
            
            $result = Download::getList(array(
                'filter' => array(
                    Download::FIELD_USER_ID     => $this->getUserID(), 
                    Download::FIELD_BUYED       => false,
                    '>=' . Download::FIELD_TIME => $ordertariff->getTimeBegin(),
                    '<'  . Download::FIELD_TIME => $ordertariff->getTimeFinish(),
                )
            ), false);
            $this->download = (int) $result->getSelectedRowsCount();
        }
        return $this->download;
    }
    
    
    /**
     * Получение количества возможных скачиваний.
     */
    public function getDownloadsLimit()
    {
        $tariff = $this->getTariff();
        if (empty($tariff)) {
            return 0;
        }
        return ($tariff->getDownloadLimit() - $this->getDownloadsCountInTariff());
    }
    
    
    
    
    /**
     * Возможно ли скачать изображение.
     */
    public function canDownload($pid = null)
    {
        $pid = intval($pid);
        
        $result = ($this->getDownloadsLimit() > 0 && !$this->isExpire());
        
        if ($pid > 0) {
            $picture = new Picture($pid);
            $canload = $picture->canDownloadBuyedByUser($this->getUserID());
            
            $result = ($result || $canload);
        }
        
        return $result;
    }
    
    
    /**
     * Есть ли возможность посмотреть информацию.
     */
    public function canInfoView()
    {
        if ($this->isExpire()) {
            return false;
        }
        $features = $this->getTariff()->getFeatures();
        $result = array_key_exists(\Glyf\Oscar\Features\Info::CODE, $features);
        
        return $result;
    }
    
    
    /**
     * Есть ли возможность посмотреть увеличенное изображение.
     */
    public function canZoom()
    {
        if ($this->isExpire()) {
            return false;
        }
        
        $features = $this->getTariff()->getFeatures();
        $result = array_key_exists(\Glyf\Oscar\Features\Zoom::CODE, $features);
        
        return $result;
    }
    
    
    /**
     * Есть ли возможность посмотреть изображение без водяного знака.
     */
    public function canWatermark()
    {
        if ($this->isExpire()) {
            return false;
        }
        $features = $this->getTariff()->getFeatures();
        $result = array_key_exists(\Glyf\Oscar\Features\Watermark::CODE, $features);
        
        return $result;
    }
    
    
    /**
     * Есть ли возможность просматривать изображения для указанных IP.
     */
    public function canMultipleIP()
    {
        if ($this->isExpire()) {
            return false;
        }
        $features = $this->getTariff()->getFeatures();
        $result = array_key_exists(\Glyf\Oscar\Features\Multiple::CODE, $features);
        
        return $result;
    }
    
    
    
    /**
     * Находится ли пользователь в каком-либо из указанных IP.
     */
    public function inZoneIP()
    {
        $userIP = $_SERVER['REMOTE_ADDR'];
        
        //return IPAddress::check()
    }
}

