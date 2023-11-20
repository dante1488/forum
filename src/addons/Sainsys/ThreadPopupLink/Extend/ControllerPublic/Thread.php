<?php

namespace Sainsys\ThreadPopupLink\Extend\ControllerPublic;

use XF\Mvc\ParameterBag;
use XF\Mvc\FormAction;

class Thread extends XFCP_Thread
{
    protected function threadSaveProcess(\XF\Entity\Thread $thread)
    {

        var_dump($thread);
        die();
        $form = parent::threadSaveProcess($thread);


        return $form;
    }


    protected function _postSave()
    {
        parent::_postSave();

    }

    protected function _postDelete()
    {
        parent::_postDelete();

    }

}