<?php

namespace Sainsys\ThreadPopupLink\Entity;

use XF\Mvc\Entity\Structure;
use XF\Mvc\Entity\Entity;

class ThreadLink extends Entity
{
    /**
     * Определение структуры сущности
     *
     * @param Structure $structure
     * @return Structure
     */

    public static function getStructure(Structure $structure)
    {
        $structure->table = 'xf_thread_popup_link';
        $structure->shortName = 'Sainsys\ThreadPopupLink:Link';
        $structure->primaryKey = 'link_id';
        $structure->columns = [
            'link_id' => ['type' => self::UINT, 'autoIncrement' => true],
            'thread_id' => ['type' => self::UINT, 'required' => true],
            'title' => ['type' => self::STR, 'required' => true],
            'url' => ['type' => self::STR, 'required' => true],
            'enable' => ['type' => self::INT, 'required' => true],
            'color' => ['type' => self::STR, 'default' => '#000000'],
        ];

        $structure->relations = [
            'Thread' => [
                'type' => self::TO_ONE,
                'entity' => 'XF:Thread',
                'conditions' => 'thread_id',
                'primary' => true
            ]
        ];

        return $structure;
    }
}