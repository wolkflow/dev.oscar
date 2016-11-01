<?php

namespace Glyf\Oscar;

use Glyf\Oscar\Lightbox;


class User extends \Glyf\Core\User
{
    /**
     * �������������� � ������ ���������.
     */
    public function isPartner()
    {
        $this->load();
        
        return (in_array(GROUP_PARTNERS_ID, $this->getGroupIDs()));
    }
    
    
    /**
     * ��������� IP ������������.
     */
    public function getIP()
    {
        return $_SERVER['REMOTE_ADDR'];
    }
    
    
    /**
     * ��������� ������ ������������.
     */
    public function getTariff()
    {
        
    }
    
    
    /**
     * ��������� ���������� ��������� ������
     */
    public function getCountDownloadPictures(Glyf\Oscar\Tariff $tariff = null, $permonth = false)
    {
        $params = array();
    }
    
    
    /**
     * ��������� ���������� �� ������.
     */
    public function getAccesses()
    {
        
    }
    
    
    /**
     * �������� ������ � ��������� �������� ������������.
     */
    public function getBalance()
    {
        if (!\Bitrix\Main\Loader::includeModule('sale')) {
            return false;
        }
        
        $account = \CSaleUserAccount::GetByUserID($this->getID(), CURRENCY_DEFAULT);
        $budget  = (float) $account['CURRENT_BUDGET'];
        
        return $budget;
    }
    
    
    /**
     * ��������� ������ ������������.
     */
    public function getLightboxes($filters = array())
    {
        return Lightbox::getUserLightboxes($this->getID(), $filters);
    }
}