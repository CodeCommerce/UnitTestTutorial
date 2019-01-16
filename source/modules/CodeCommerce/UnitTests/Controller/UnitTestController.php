<?php

namespace CodeCommerce\UnitTests\Controller;

use OxidEsales\Eshop\Core\Registry;

class UnitTestController
{
    /**
     * @param $article
     * @return bool
     */
    public function articleCheck($article)
    {
        if ($oxid = $article->getId()) {
            return $oxid;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function getConfigParamForArticleOption()
    {
        if (Registry::getConfig()->getConfigParam('testParam')) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function getMultipleConfigParams()
    {
        if (Registry::getConfig()->getConfigParam('testParam1') &&
            Registry::getConfig()->getConfigParam('testParam2')) {
            return true;
        }

        return false;
    }

    /**
     * @param $article
     * @return bool
     */
    protected function _articleTitleCheck($article)
    {
        if ($title = $article->getTitle()) {
            return $title;
        }

        return false;
    }
}
