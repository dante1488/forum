<?php

namespace Sainsys\ThreadPopupLink\XF\Entity;

class Thread extends XFCP_Thread
{
    public function _postSave()
    {
        parent::_postSave();
        if($this->isChanged('custom_fields')){

        }
    }

    protected function _postDelete()
    {
        parent::_postDelete();
        $db = $this->db();
        $db->delete('xf_thread_popup_link', 'thread_id = ?', $this->thread_id);
    }

}