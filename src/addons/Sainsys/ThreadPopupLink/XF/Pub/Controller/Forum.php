<?php

namespace Sainsys\ThreadPopupLink\XF\Pub\Controller;

use Truonglv\ThreadCustomFieldsLink\Repository\ThreadLink;
use XF\Mvc\ParameterBag;
class Forum extends XFCP_Forum
{

    public function actionPostThread(ParameterBag $params)
    {
        $response = parent::actionPostThread($params);

        if ($this->isPost() && $response instanceof \XF\Mvc\Reply\Redirect) {
            if ($response->getUrl() !== null) {
                $threadId = $this->getThreadIdFromRedirect($response->getUrl());

                /** @var ThreadLink $threadLinkRepo */
                $threadLinkRepo = $this->repository('Sainsys\ThreadPopupLink:ThreadLink');

                $inputs = $this->filter([
                    'links' => 'array',
                ]);

                if (count($inputs['links']) > 5) {
                    return $this->error(\XF::phrase('maximum_number_of_links_exceeded'));
                }

                $threadLinkRepo->saveLinkData($threadId, $inputs);
            }
        }

        return $response;
    }

    protected function getThreadIdFromRedirect($url)
    {
        $urlParts = parse_url($url);
        if (isset($urlParts['path'])) {
            $pathSegments = explode('/', trim($urlParts['path'], '/'));
            $threadString = explode('.', end($pathSegments));
            $threadId = end($threadString);

            return is_numeric($threadId) ? intval($threadId) : null;
        }

        return null;
    }

}