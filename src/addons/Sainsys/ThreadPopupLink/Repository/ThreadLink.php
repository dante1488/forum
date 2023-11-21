<?php

namespace Sainsys\ThreadPopupLink\Repository;

use XF\Db\Exception;
use XF\Entity\Thread;
use XF\Mvc\Entity\Repository;

class ThreadLink extends Repository
{

    /**
     * Получаем ссылки к теме.
     *
     * @param Thread $thread
     * @return \XF\Mvc\Entity\Finder
     */

    public function getThreadLinks(Thread $thread)
    {
        $visitor = \XF::visitor();

        return $this->finder('Sainsys\ThreadPopupLink:ThreadLink')
            ->where('thread_id', $thread->thread_id);
    }

    /**
     * Добавляет ссылки к теме.
     *
     * @param int $threadId ID темы
     * @param array $links Массив ссылок
     * @return void
     */

    public function saveLinkData($threadId, array $links)
    {
        foreach ($links['links'] as $linkData) {
            try{
                if (isset($linkData['title'], $linkData['url'], $linkData['color'], $linkData['enable'])) {
                    /** @var \Sainsys\ThreadPopupLink\Entity\ThreadLink $link */
                    $link = $this->em->create('Sainsys\ThreadPopupLink:ThreadLink');

                    $link->thread_id = $threadId;
                    $link->title = $linkData['title'];
                    $link->url = $linkData['url'];
                    $link->color = $linkData['color'];
                    $link->enable = $linkData['enable'];

                    $link->save();
                }
            } catch (Exception $e){
                $this->error(\XF::phrase('something_wrong_with_db'));
            }

        }
    }

}