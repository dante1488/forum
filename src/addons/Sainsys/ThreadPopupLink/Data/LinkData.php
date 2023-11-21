<?php

namespace Sainsys\ThreadPopupLink\Data;

use XF\Mvc\Entity\AbstractCollection;

class LinkData
{
    /**
     * @var AbstractCollection|null
     */
    private $data;


    /**
     * @param AbstractCollection $data
     * @return void
     */
    public function setData(AbstractCollection $data)
    {
        $this->data = $data;
    }

    /**
     * @return AbstractCollection|null
     */
    public function getData()
    {
        return $this->data;
    }
}