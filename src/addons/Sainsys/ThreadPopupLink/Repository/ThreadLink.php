<?php

namespace Sainsys\ThreadPopupLink\Repository;

use XF\Entity\Thread;
use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Finder;
use XF\Mvc\Entity\Manager;
use XF\Mvc\Entity\Repository;

class ThreadLink extends Repository
{

    /**
     * @param Thread $thread
     * @return \XF\Mvc\Entity\Finder
     */

    public function getThreadLinks(Thread $thread)
    {
        $visitor = \XF::visitor();

        return $this->finder('Sainsys\ThreadPopupLink:ThreadLink')
            ->where('link_thread_id', $thread->thread_id)
            ->with('Thread', true)
            ->with('Thread.User')
            ->with('Thread.Forum.Node.Permissions|' . $visitor->permission_combination_id)
            ->where('Thread.discussion_state', 'visible');
    }

    public function saveLinkData(array $linkData)
    {
        // Логика для сохранения или обновления данных о ссылке
    }

}