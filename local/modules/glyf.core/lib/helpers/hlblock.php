<?php

namespace Glyf\Core\Helpers;

class HLBlock
{
    
    /**
     * Получение свойств инфоблока.
     */
    public static function getProps($hlblockID, $key = 'FIELD_NAME', $keyenum = 'XML_ID', $lower = true)
    {
        $props = array();
        
        $result = \CUserTypeEntity::GetList(array(), array('ENTITY_ID' => 'HLBLOCK_' . $hlblockID));
        while ($prop = $result->Fetch()) {
            if ($prop['USER_TYPE_ID'] == 'enumeration') {
                $res = \CUserFieldEnum::GetList(array(), array('USER_FIELD_ID' => $prop['ID']));
                while ($enum = $res->GetNext()) {
                    $enumindex = $enum[$keyenum];
                    if ($lower) {
                        $enumindex = mb_strtolower($enumindex);
                    }
                    $prop['ENUMS'][$enumindex] = $enum;
                }
            }
            $props[$prop[$key]] = $prop;
        }
        unset($prop, $result);
        
        return $props;
    }

}