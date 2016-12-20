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
     * ��������� ID ������������.
     */
    public function getUserID()
    {
        return $this->uid;
    }
    
    
    /**
     * ��������� ������� �������.
     */
    public function getTime()
    {
        return $this->time;
    }
    
    
    /**
     * ��������� ������.
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
     * ��������� ���� ��������� ������.
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
     * ��������� ��������� ������.
     */
    public function getOrderTariff()
    {
        if (empty($this->ordertariff)) {
            $this->ordertariff = OrderTariff::current();
        }
        return $this->ordertariff;
    }
    
    
    /**
     * �������� ����� �������� ������.
     */
    public function isExpire()
    {
        if ($this->getExpire() <= time()) {
            return true;
        }
        return false;
    }
    
    
    /**
     * ��������� ���������� ����������.
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
     * ��������� ���������� ���������� �� ������.
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
     * ��������� ���������� ��������� ����������.
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
     * �������� �� ������� �����������.
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
     * ���� �� ����������� ���������� ����������.
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
     * ���� �� ����������� ���������� ����������� �����������.
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
     * ���� �� ����������� ���������� ����������� ��� �������� �����.
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
     * ���� �� ����������� ������������� ����������� ��� ��������� IP.
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
     * ��������� �� ������������ � �����-���� �� ��������� IP.
     */
    public function inZoneIP()
    {
        $userIP = $_SERVER['REMOTE_ADDR'];
        
        //return IPAddress::check()
    }
}

