<?php

namespace Glyf\Oscar;

use Glyf\Core\System\HLBlockModel;

class Search extends HLBlockModel
{
    const FIELD_ID     = 'ID';
    const FIELD_TIME   = 'UF_TIME';
    const FIELD_USER   = 'UF_USER';
    const FIELD_TITLE  = 'UF_TITLE';
    const FIELD_FIELDS = 'UF_FIELDS';
    
    const FILTERS_CODE = 'F';
    
    static protected $hlblockID = HLBLOCK_SEARCHES_ID;
    
    
    public function getUserID()
    {
        return $this->get(self::FIELD_USER);
    }
    
    
    public function getTitle()
    {
        return $this->get(self::FIELD_TITLE);
    }
    
    
    public function getSourceFields()
    {
        return $this->get(self::FIELD_FIELDS);
    }
    
    
    public function getFields()
    {
        return array(self::FILTERS_CODE => json_decode($this->get(self::FIELD_FIELDS), true));
    }
    
    
    public function getLink()
    {
        $fields = $this->getFields();
        
        return http_build_query($fields);
    }
    
    
    public function getFilter()
    {
        $filters = $this->getFields();
        $filters = $filters[self::FILTERS_CODE];
        
        try {
            $filter = new \Glyf\Oscar\Filters\Picture();
        } catch (Exception $e) {
            return array();
        }
        
        // Название.
		if (!empty($filters['TITLE'])) {
			$filter->setTitle($filters['TITLE']);
		}
        
        // Автор.
		if (!empty($filters['AUTHOR'])) {
			$filter->setAuthor($filters['AUTHOR']);
		}
        
        // Правообладатель.
		if (!empty($filters['HOLDER'])) {
			$filter->setHolder($filters['HOLDER']);
		}
        
        // Период.
		if (!empty($filters['PERIOD_FROM']) || !empty($filters['PERIOD_TO'])) {
			$filter->setPeriod($filters['PERIOD_FROM'], $filters['PERIOD_TO'], $filters['PERIOD_FROM_ERA'], $filters['PERIOD_TO_ERA'], $filters['ISYEAR']);
		}
        
        // Техника.
		if (!empty($filters['TECHNIQUE'])) {
			$filter->setTechnique($filters['TECHNIQUE']);
		}
        
        // ID.
		if (!empty($filters['ID'])) {
			$filter->setIDs($filters['ID']);
		}
        
        // Ключевые слова.
		if (!empty($filters['KEYWORDS'])) {
			$filter->setKeywords(explode(',', $filters['KEYWORDS']));
		}
        
        // Коллекции.
		if (!empty($filters['COLLECTION'])) {
			$filter->setCollections($filters['COLLECTION']);
		}
        
        // Жанр.
		if (!empty($filters['GENRE'])) {
			$filter->setGenre($filters['GENRE']);
		}
        
        // Местоположение.
		if (!empty($filters['COUNTRY'])) {
			$filter->setPlace($filters['COUNTRY'], $filters['CITY']);
		}
        
        // Размеры.
		if (!empty($filters['SIZEMIN']) || !empty($filters['SIZEMAX'])) {
			$filter->setSize($filters['SIZEMIN'], $filters['SIZEMAX']);
		}
        
        // Цвет.
		if (!empty($filters['COLOR'])) {
			$filter->setColor($filters['COLOR']);
		}
        
        // Правовой режим.
		if (!empty($filters['LEGAL'])) {
			$filter->setLegal($filters['LEGAL']);
		}
        
        // Модерация.
        $filter->setModerate(true);
        
        
        return $filter->getFilter();
    }
}