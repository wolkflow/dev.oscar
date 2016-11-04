<?php

namespace Glyf\Oscar;

use Glyf\Oscar\Lightbox;
use Glyf\Oscar\Tariff;
use Glyf\Oscar\UserTariff;
use Glyf\Oscar\Subscribe;


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
    public function getUserTariff()
    {
        if (!\Bitrix\Main\Loader::includeModule('sale')) {
            return;
        }
        
        $result = \CSaleOrder::getList(
            array('DATE_PAYED' => 'DESC'),
            array('USER_ID' => $this->getID(), 'XML_ID' => Tariff::XML_ORDER)
        );
        
        $tariff = null;
        
        if ($order = $result->fetch()) {
            $basket = reset(\Glyf\Core\Helpers\SaleOrder::getBaskets($order['ID']));
            
            if (!empty($order['DATE_PAYED'])) {
                $tariff = new UserTariff($this->getID(), strtotime($order['DATE_PAYED']), (new Tariff($basket['PRODUCT_ID'])));
            }
        }
        return $tariff;
    }
    
    
    /**
     * ��������� ���������� �� ������.
     */
    public function getAccesses()
    {
        $usertariff = $this->getUserTariff();
        
        $features = array();
        if (!is_null($usertariff)) {
            $tariff   = $usertariff->getTariff();
            $features = $tariff->getFeatures();
        }
        return $features;
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
     * ��������� ���������� ������������.
     */
    public function getLightboxesCount($filters = array())
    {
        $result = Lightbox::getUserLightboxes($this->getID(), $filters,false);
        
        return ($result->getSelectedRowsCount());
    }
    
    
    /**
     * ��������� ������ ������������.
     */
    public function getLightboxes($params = array())
    {
        return Lightbox::getUserLightboxes($this->getID(), $params);
    }
    
    
    /**
     * ��������� ��������.
     */
    public function getSubscribe()
    {
        $subscribe = Subscribe::getList(array('filter' => array(Subscribe::FIELD_USER_ID => $this->getID())));
        $subscribe = reset($subscribe);
        
        return $subscribe;
    }
}