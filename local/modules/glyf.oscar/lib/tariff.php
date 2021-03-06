<?php

namespace Glyf\Oscar;

use Glyf\Core\System\ProductModel;

class Tariff extends ProductModel
{
    const IBLOCK_ID = IBLOCK_TARIFFS_ID;
    
    const XML_ORDER = 'TARIFF';
    
    
    protected $limit = 0;
    
    
    /**
     * Получение названия тарифа.
     */
    public function getTitle()
    {
        $this->load();
        
        $title = $this->data['PROPS']['LANG_TITLE_' . CURRENT_LANG_UP]['VALUE'];
        
        return $title;
    }
    
    
    /**
     * Получение цены тарифа.
     */
    public function getPrice()
    {
        $this->load();
        
        return $this->data['PRICE'];
    }
    
    
    /**
     * Получение доступов.
     */
    public function getFeatures()
    {
        $this->load();
        
        // Значение свойства.
        $property = $this->data['PROPS']['FEATURES'];
        
        $features = array();
        foreach ($property['VALUE_XML_ID'] as $i => $code) {
            $features[$code] = $property['VALUE'][$i];
        }
        return $features;
    }
    
    
    /**
     * Получение лимита скачиваний для данного тарифа.
     */
    public function getDownloadLimit()
    {
        if (empty($this->limit)) {
            $features = $this->getFeatures();
            
            foreach ($features as $code => $title) {
                // 25 скачиваний.
                if ($code == \Glyf\Oscar\Features\Download25::CODE) {
                    $limit = \Glyf\Oscar\Features\Download25::LIMIT;
                    if ($this->limit < $limit) {
                        $this->limit = $limit;
                    }
                }
                
                // 50 скачиваний.
                if ($code == \Glyf\Oscar\Features\Download50::CODE) {
                    $limit = \Glyf\Oscar\Features\Download50::LIMIT;
                    if ($this->limit < $limit) {
                        $this->limit = $limit;
                    }
                }
            }
        }
        return $this->limit;
    }
}