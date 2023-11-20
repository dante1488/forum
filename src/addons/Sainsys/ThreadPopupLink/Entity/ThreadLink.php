<?php

namespace Sainsys\ThreadPopupLink\Entity;

use XF\Mvc\Entity\Structure;
use XF\Mvc\Entity\Entity;

class ThreadLink extends Entity
{
    public static function getStructure(Structure $structure)
    {
        $structure->table = 'thread_popup_links';
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

        return $structure;
    }
}