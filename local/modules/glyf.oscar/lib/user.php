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
     * Получени данных о платежном аккаунте пользователя.
     */
    public function getAccountBudget()
    {
        $account = CSaleUserAccount::GetByUserID($this->getID(), CURRENCY_DEFAULT);
        $budget  = (float) $account['CURRENT_BUDGET'];
        
        return $budget;
    }
}