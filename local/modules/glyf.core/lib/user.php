<?php

namespace Glyf\Core;

class User
{
    const FIELD_NAME            = 'NAME';
    const FIELD_LOGIN           = 'LOGIN';
    const FIELD_EMAIL           = 'EMAIL';
    const FIELD_PERSONAL_MOBILE = 'PERSONAL_MOBILE';
    const FIELD_WORK_POSITION   = 'WORK_POSITION';
    const FIELD_WORK_COMPANY    = 'WORK_COMPANY';
    const FIELD_GROUP_ID        = 'GROUP_ID';
    
    protected $id   = null;
    protected $data = null;
    
    protected static $users = array();
    
   
    public function __construct($id = false, $data = array())
    {
        if (!$id) {
            $id = \CUser::GetID();
        } else {
            if (!empty($data)) {
                $this->data = (array) $data;
            }
        }
        $this->id = (int) $id;
    }
    
    
    public function getID()
    {
        return $this->id;
    }
    
    
    /**
     * Загрузка данных из БД.
     */
    public function load()
    {
        if ($this->data !== null) {
            return;
        }

        if (intval($this->getID()) <= 0) {
            return;
        }
        
        if (isset(self::$users[$this->getID()])) {
            $this->data = self::$users[$this->getID()];
            return;
        }

        $data = \CUser::GetList($b, $o, array('ID' => $this->getID()), array('SELECT' => array('UF_*')))->fetch();
        if ($data !== false) {
            $data['GROUP_ID'] = \CUser::GetUserGroup($this->getID());
        }
        self::$users[$this->getID()] = $this->data = $data;
    }
    
    
    public function unload()
    {
        unset($this->data);
        unset(self::$users[$this->getID()]);
    }
    
    
    public function get($code)
    {
        $this->load();

        return $this->data[strval($code)];
    }

    
    public function update($data)
    {
        $data = (array) $data;
        $user = new \CUser();

        return $user->Update($this->getID(), $data);
    }
    
    
    public function getGroupIDs()
    {
        return $this->get(self::FIELD_GROUP_ID);
    }
    
    
    public function getName()
    {
        return $this->get(self::FIELD_NAME);
    }
    
    
    public function getEmail()
    {
        return $this->get(self::FIELD_EMAIL);
    }
    
    
    public function getLogin()
    {
        return $this->get(self::FIELD_LOGIN);
    }
    
    
    public function getPersonalMobile()
    {
        return $this->get(self::FIELD_PERSONAL_MOBILE);
    }
    
    
    public function getWorkCompany()
    {
        return $this->get(self::FIELD_WORK_COMPANY);
    }
    
    
    public function getWorkPosition()
    {
        return $this->get(self::FIELD_WORK_POSITION);
    }
    
    
    
    public static function findByLogin($login)
    {
        $login = trim((string) $login);

        if (strlen($login) > 0) {
            $result = \CUser::GetList(
                ($b = 'ID'),
                ($o = 'ASC'),
                array('=' . self::FIELD_LOGIN => $login),
                array('NAV_PARAMS' => array('nTopCount' => 1))
            );
            if ($data = $result->Fetch()) {
                return new static($data['ID'], $data);
            }
        }
        return null;
    }
    
    
    public static function getEntityClassName()
    {
        return '\Bitrix\Main\UserTable';
    }
}