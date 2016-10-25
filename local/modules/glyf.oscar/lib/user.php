<?php

namespace Glyf\Oscar;

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
     * �������� ������ � ��������� �������� ������������.
     */
    public function getAccountBudget()
    {
        $account = CSaleUserAccount::GetByUserID($this->getID(), CURRENCY_DEFAULT);
        $budget  = (float) $account['CURRENT_BUDGET'];
        
        return $budget;
    }
}