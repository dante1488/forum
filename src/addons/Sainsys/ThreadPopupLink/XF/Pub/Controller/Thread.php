<?php

namespace Sainsys\ThreadPopupLink\XF\Pub\Controller;

use Sainsys\ThreadPopupLink\Repository\ThreadLink;
use XF\Mvc\ParameterBag;
use XF\Mvc\Reply\View;

class Thread extends XFCP_Thread
{

    public function actionIndex(ParameterBag $params)
    {
        $response = parent::actionIndex($params);

        $page = $this->filterPage($params->page);
        if ($response instanceof View
            && $page === 1
            && $response->getParam('thread') !== null
        ) {
            /** @var \XF\Entity\Thread $thread */
            $thread = $response->getParam('thread');

            /** @var ThreadLink $threadLinkRepo */
            $threadLinkRepo = $this->repository('Sainsys\ThreadPopupLink:ThreadLink');
            $linkThreads = $threadLinkRepo->getThreadLinks($thread)->fetch();

            /** @var LinkData $linkData */
            $linkData = $this->data('Sainsys\ThreadPopupLink:LinkData');

            if ($linkThreads->count() > 0) {
                $linkData->setData($linkThreads);
            }
        }

        return $response;
    }
}