<?php

namespace Glyf\Oscar;

use Glyf\Core\System\HLBlockModel;


class Subscribe extends HLBlockModel
{
    const FIELD_ID               = 'ID';
    const FIELD_USER_ID          = 'UF_USER_ID';
    const FIELD_PERIOD           = 'UF_PERIOD';
    const FIELD_ACTIVE           = 'UF_ACTIVE';
    const FIELD_KIND_COLLECTIONS = 'UF_KIND_COLLECTIONS';
    const FIELD_KIND_BLOGS       = 'UF_KIND_BLOGS';
    const FIELD_KIND_SEARCHES    = 'UF_KIND_SEARCHES';
    const FIELD_LAST_TIME        = 'UF_LAST_TIME';
    
    const PERIOD_WEEKLY  = 'WEEKLY';
    const PERIOD_MONTHLY = 'MONTHLY';
    const PERIOD_QUARTLY = 'QUARTLY';
    
    static protected $hlblockID = HLBLOCK_SUBSCRIBES_ID;
    
    
    
    public function getUserID()
    {
        return $this->get(self::FIELD_USER_ID);
    }
    
    
    public function getPeriod()
    {
        return $this->get(self::FIELD_PERIOD);
    }
    
    
    public function getPeriodTime()
    {
        $period = $this->getPeriod();
    }
    
    
    public function getActive()
    {
        return $this->get(self::FIELD_ACTIVE);
    }
    
    
    public function getKindCollections()
    {
        return $this->get(self::FIELD_KIND_COLLECTIONS);
    }
    
    
    public function getKindBlogs()
    {
        return $this->get(self::FIELD_KIND_BLOGS);
    }
    
    
    public function getKindSearches()
    {
        return $this->get(self::FIELD_KIND_SEARCHES);
    }
    
    
    public function getLastTime()
    {
        return $this->get(self::FIELD_LAST_TIME);
    }
    
    
    /**
     * Обновление времени последней отправки.
     */
    public function retime()
    {
        $this->update(array(
            self::FIELD_LAST_TIME => new \Bitrix\Main\Type\DateTime()
        ));
    }
}