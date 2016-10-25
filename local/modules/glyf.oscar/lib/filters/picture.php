<?php

namespace Glyf\Oscar\Filters;

use Glyf\Core\System\IBlockSectionModel;
use Glyf\Core\Helpers\NumConvertor;
use glyf\Oscar\Collection;
use glyf\Oscar\Picture as PictureElement;

class Picture extends \Glyf\Core\Filters\HLBlockElement
{
	protected static $hlblockID = HLBLOCK_PICTURES_ID;
    
    
    /**
     * фильтр по заголовку.
     */
    public function setTitle($value)
    {
        $this->params['filter'] []= array(
            'LOGIC' => 'OR',
            array(PictureElement::FIELD_LANG_TITLE_RU => '%'.strval($value).'%'),
            array(PictureElement::FIELD_LANG_TITLE_EN => '%'.strval($value).'%'),
        );
    }
    
    
    /**
     * фильтр по автору.
     */
    public function setAuthor($value)
    {
        $this->params['filter'][PictureElement::FIELD_AUTHOR] = intval($value);
    }
    
    
    /**
     * фильтр по правообладателю.
     */
    public function setHolder($value)
    {
        $this->params['filter'][PictureElement::FIELD_HOLDER] = intval($value);
    }
    
    
    
    /**
     * фильтр по периоду.
     */
    public function setPeriod($valF = false, $valT = false, $eraF = 'BC', $eraT = 'BC', $isyear = false)
    {
        if (!$valF && !$valT) {
            return;
        }
        
        // Является ли указанное годом или веокм.
        $isyear = (bool) $isyear;
        
        // До или после нашей эры.
        $eraF = ($eraF == PictureElement::PROP_TIME_AD) ? (PictureElement::PROP_TIME_AD) : (PictureElement::PROP_TIME_BC);
        $eraT = ($eraT == PictureElement::PROP_TIME_AD) ? (PictureElement::PROP_TIME_AD) : (PictureElement::PROP_TIME_BC);
        
        // Конвертор римских числел.
        $convertor = new NumConvertor();
        
        // Преобразование чисел в год в случае указания века.
        if (!$isyear) {
            if ($valF) {
                if (is_numeric($valF)) {
                    // Арабские числа.
                    $valF = intval($valF) * TIME_YEARS_IN_CENTURY;
                } else {
                    // Римские числа.
                    $valF = $convertor->fromRoman(strtoupper($valF)) * TIME_YEARS_IN_CENTURY;
                }
            }
            
            if ($valT) {
                if (is_numeric($valT)) {
                    // Арабские числа.
                    $valF = intval($valT) * TIME_YEARS_IN_CENTURY;
                } else {
                    // Римские числа.
                    $valT = $convertor->fromRoman(strtoupper($valT)) * TIME_YEARS_IN_CENTURY;
                }
            }
        }
        
        // Если даты являются датами до н.э. возьмем их отрицание.
        if ($eraF == PictureElement::PROP_TIME_BC) {
            $valF *= -1;
        }
        if ($eraT == PictureElement::PROP_TIME_BC) {
            $valT *= -1;
        }
        
        if ($valF && $valT) {
            $this->params['filter']['>='.PictureElement::FIELD_PERIOD_FROM] = $valF;
            $this->params['filter']['<='.PictureElement::FIELD_PERIOD_TO]   = $valT;
            if (!$isyear) {
                if ($eraF == PictureElement::PROP_TIME_AD) {
                    $this->params['filter']['>='.PictureElement::FIELD_PERIOD_FROM] = $valF - TIME_YEARS_IN_CENTURY;
                }
                if ($eraT == PictureElement::PROP_TIME_BC) {
                    $this->params['filter']['<='.PictureElement::FIELD_PERIOD_TO] = $valT + TIME_YEARS_IN_CENTURY;
                }
            }
        } elseif ($valF) {
            if ($isyear) {
                $this->params['filter'][PictureElement::FIELD_PERIOD_FROM] = intval($valF);
            } else {
                if ($eraF == PictureElement::PROP_TIME_BC) {
                    $this->params['filter']['>='.PictureElement::FIELD_PERIOD_FROM] = intval($valF);
                    $this->params['filter']['<='.PictureElement::FIELD_PERIOD_TO]   = intval($valF) + TIME_YEARS_IN_CENTURY;
                } else {
                    $this->params['filter']['>='.PictureElement::FIELD_PERIOD_FROM] = intval($valF) - TIME_YEARS_IN_CENTURY;
                    $this->params['filter']['<='.PictureElement::FIELD_PERIOD_TO]   = intval($valF);
                }
            }
        } else {
            if ($isyear) {
                $this->params['filter'][PictureElement::FIELD_PERIOD_TO] = intval($valT);
            } else {
                if ($eraT == PictureElement::PROP_TIME_BC) {
                    $this->params['filter']['>='.PictureElement::FIELD_PERIOD_FROM] = intval($valT);
                    $this->params['filter']['<='.PictureElement::FIELD_PERIOD_TO]   = intval($valT) + TIME_YEARS_IN_CENTURY;
                } else {
                    $this->params['filter']['>='.PictureElement::FIELD_PERIOD_FROM] = intval($valT) - TIME_YEARS_IN_CENTURY;
                    $this->params['filter']['<='.PictureElement::FIELD_PERIOD_TO]   = intval($valT);
                }
            }
        }
    }
    
    
    /**
     * фильтр по технике.
     */
    public function setTechnique($values)
    {
        $this->params['filter'][PictureElement::FIELD_TECHNIQUE] = array_filter(array_map('intval', (array) $values));
    }
    
    
    /**
     * фильтр по ключевым словам.
     */
    public function setKeywords($values)
    {
        $this->params['filter'][PictureElement::FIELD_KEYWORDS] = array_filter(array_map('strval', (array) $values));
    }
    
    
     /**
     * фильтр по периоду.
     */
    public function setCollection($values)
    {
        $values = array_filter(array_map('strval', (array) $values));
        $values = IBlockSectionModel::getFullSubsectionIDs($values);
        $values = array_unique($values);
        
        $this->params['filter'][PictureElement::FIELD_COLLECTION] = $values;
    }
    
    
    /**
     * фильтр по жанру.
     */
    public function setGenre($values)
    {
        $this->params['filter'][PictureElement::FIELD_GENRE] = array_filter(array_map('intval', (array) $values));
    }
    
    
    /**
     * фильтр по жанру.
     */
    public function setPlace($values)
    {
        // $this->params['filter'][PictureElement::FIELD_PLACE] = array_filter(array_map('intval', (array) $values));
    }
    
    
    /**
     * фильтр по размеру.
     */
    public function setSize($width = false, $height = false)
    {
        if ($width) {
            $this->params['filter'][PictureElement::FIELD_WIDTH] = intval($width);
        }
        if ($height) {
            $this->params['filter'][PictureElement::FIELD_HEIGHT] = intval($height);
        }
    }
    
    
    /**
     * фильтр по цвету.
     */
    public function setColor($values)
    {
        $this->params['filter'][PictureElement::FIELD_COLOR] = array_filter(array_map('intval', (array) $values));
    }
    
    
    /**
     * фильтр по правовому режиму.
     */
    public function setLegal($values)
    {
        $this->params['filter'][PictureElement::FIELD_LEGAL] = array_filter(array_map('intval', (array) $values));
    }
    
    
    /**
     * Фильтр по модерации.
     */
    public function setModerate($value)
    {
        $this->params['filter'][PictureElement::FIELD_MODERATE] = (bool) $value;
    }
}










