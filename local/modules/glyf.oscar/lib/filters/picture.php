<?php

namespace Glyf\Oscar\Filters;

use Glyf\Core\System\IBlockSectionModel;
use Glyf\Core\Helpers\NumConvertor;
use Glyf\Oscar\Collection;
use Glyf\Oscar\Picture as PictureElement;

class Picture extends \Glyf\Core\Filters\HLBlockElement
{
	protected static $hlblockID = HLBLOCK_PICTURES_ID;
    
    
    /**
     * фильтр по ID.
     */
    public function setID($value)
    {
        $value = (int) ltrim(preg_replace('/(\D)/', '', (string) $value), '0');
        
        if (!empty($value)) {
			$this->params['filter']['ID'] = $value;
		}
    }
    
    
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
        $values = array_filter(array_unique(array_map('trim', array_map('strval', (array) $values))));
        
        foreach ($values as &$value) {
            $value = '%' . $value . '%';
        }
        
        $result = \Glyf\Oscar\Dictionaries\Keyword::getList(
            array(
                'select' => array('ID'), 
                'filter' => array(array(
                    'LOGIC' => 'OR',
                    array('UF_LANG_NAME_RU' => $values),
                    array('UF_LANG_NAME_EN' => $values),
                ))
            ),
            false
        );
        
        $ids = array();
        while ($item = $result->fetch()) {
            $ids []= $item['ID'];
        }
        
        if (empty($ids)) {
            $this->reset();
        } else {
            $this->params['filter'][PictureElement::FIELD_KEYWORDS] = array_filter(array_map('intval', (array) $ids));
        }
    }
    
    
     /**
     * фильтр по периоду.
     */
    public function setCollections($values)
    {
        $values = array_filter(array_map('intval', (array) $values));
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
    public function setPlace($country = false, $city = false)
    {
        if ($country) {
            $this->params['filter'][PictureElement::FIELD_PLACE_COUNTRY_ID] = intval($country);
        }
        
        if ($city) {
            $this->params['filter'][PictureElement::FIELD_PLACE_CITY_ID] = intval($city);
        }
    }
    
    
    /**
     * фильтр по размеру.
     */
    public function setSize($min = false, $max = false)
    {
        if ($min > 0 && $max > 0) {
            $this->params['filter'] []= array(
                'LOGIC' => 'OR',
                array('>=' . PictureElement::FIELD_WIDTH => $min,  '<=' . PictureElement::FIELD_WIDTH => $max),
                array('>=' . PictureElement::FIELD_HEIGHT => $min, '<=' . PictureElement::FIELD_HEIGHT => $max),
            );
        } else {
            if ($min > 0) {
                $this->params['filter'] []= array(
                    'LOGIC' => 'OR',
                    array('>=' . PictureElement::FIELD_WIDTH => $min),
                    array('>=' . PictureElement::FIELD_HEIGHT => $min),
                );
            }
            if ($max > 0) {
                $this->params['filter'] []= array(
                    'LOGIC' => 'OR',
                    array('<=' . PictureElement::FIELD_WIDTH => $max),
                    array('<=' . PictureElement::FIELD_HEIGHT => $max),
                );
            }
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
    public function setModerateTime($min = false, $max = false)
    {
        if (!empty($min)) {
            $this->params['filter']['>'.PictureElement::FIELD_MODERATE_TIME] = $min;
        }
        if (!empty($max)) {
            $this->params['filter']['<'.PictureElement::FIELD_MODERATE_TIME] = $max;
        }
    }
    
    
    /**
     * Фильтр по модерации.
     */
    public function setModerate($value)
    {
        $this->params['filter'][PictureElement::FIELD_MODERATE] = (bool) $value;
    }
}










