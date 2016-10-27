<?php

namespace Glyf\Oscar;

class User extends \Glyf\Core\User
{
    /**
     * Принадлежность к группе партнеров.
     */
    public function isPartner()
    {
        $this->load();
        
        return (in_array(GROUP_PARTNERS_ID, $this->getGroupIDs()));
    }
    
    
    /**
     * Получение IP пользователя.
     */
    public function getIP()
    {
        return $_SERVER['REMOTE_ADDR'];
    }
    
    
    /**
     * Получение тарифа пользователя.
     */
    public function getTariff()
    {
        
    }
    
    
    /**
     * Получение количества скачанных картин
     */
    public function getCountDownloadPictures(Glyf\Oscar\Tariff $tariff = null, $permonth = false)
    {
        $params = array();
    }
    
    
    /**
     * Получение привелегий по тарифу.
     */
    public function getAccesses()
    {
        
    }
    
    
    /**
     * Получени данных о платежном аккаунте пользователя.
     */
    public function getAccountBudget()
    {
        $account = CSaleUserAccount::GetByUserID($this->getID(), CURRENCY_DEFAULT);
        $budget  = (float) $account['CURRENT_BUDGET'];
        
        return $budget;
    }
}