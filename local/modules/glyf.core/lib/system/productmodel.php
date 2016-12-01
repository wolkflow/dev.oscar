<?php 

namespace Glyf\Core\System;

\Bitrix\Main\Loader::includeModule('catalog');

class ProductModel extends \Glyf\Core\System\IBlockModel
{
    
    /**
	 * Загрузка данных элемента.
	 *
	 * @param bool $force
	 * @return array
	 */
	public function load($force = false)
	{
		if (empty($this->data) || $force) {
            $element = \CIBlockElement::GetByID($this->getID())->GetNextElement();
			$product = \CCatalogProduct::GetByIDEx($this->getID());
            
			if ($element) {
				$this->data = $element->getFields();
				$this->data['PROPS'] = $element->getProperties();
                $this->data['PRICE'] = $product['PRICES'][PRICE_TYPE_DEFAULT]['PRICE'];
			}
		}
	}
    
    
    /**
     * получение цены.
     */
    public function getPrice()
    {
        $this->load();
        
        return floatval($this->data['PRICE']);
    }
}