<?php

namespace Glyf\Oscar;

use Glyf\Oscar\Tariff;
use Glyf\Oscar\Statistic\Download;


class UserTariff extends \Glyf\Core\System\IBlockModel
{
    protected $uid       = null;
    protected $time      = null;
    protected $tariff    = null;
    protected $downloads = null;
    
    
    public function __construct($uid, $time, Tariff $tariff)
    {
        $this->uid    = (int) $uid;
        $this->time   = (int) $time;
        $this->tariff = $tariff;
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
        return $this->tariff;
    }
    
    
    /**
     * Получение срок истечение тарифа.
     */
    public function getExpire()
    {
        return ($this->getTime() + TIME_MONTH);
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
            'filter' => array(Download::FIELD_USER_ID => $this->getUserID())
        ), false);
        
        $count = (int) $result->getSelectedRowsCount();
        
        return $count;
    }
    
    
    /**
     * Получение количества скачиваний.
     */
    public function getDownloadsCountInTariff()
    {
        if (is_null($this->download)) {
            $result = Download::getList(array(
                'filter' => array(Download::FIELD_USER_ID => $this->getUserID(), '>='.Download::FIELD_TIME => date('d.m.Y', $this->getTime()))
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
        return ($this->getTariff()->getDownloadLimit() - $this->getDownloadsCountInTariff());
    }
    
    
    
    
    /**
     * Возможно ли скачать изображение.
     */
    public function canDownload()
    {
        if ($this->isExpire()) {
            return false;
        }
        $result = ($this->getDownloadsLimit() > 0);
        
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
}

