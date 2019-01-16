<?php

namespace CodeCommerce\UnitTests\Controller;

use OxidEsales\Eshop\Application\Model\Article;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\TestingLibrary\UnitTestCase;

class UnitTestControllerTest extends UnitTestCase
{
    /**
     * @param $oxid
     * @param $expected
     * @dataProvider dataProviderArticleCheck
     */
    public function testArticleCheck($oxid, $expected)
    {
        $unitTestController = $this->getMockBuilder(UnitTestController::class)
            ->setMethods(null)
            ->disableOriginalConstructor()
            ->getMock();

        $article = $this->getMockBuilder(Article::class)
            ->setMethods(['getId'])
            ->disableOriginalConstructor()
            ->getMock();

        $article->expects($this->once())
            ->method('getId')
            ->willReturn($oxid);

        $this->assertEquals($expected, $unitTestController->articleCheck($article));
    }

    /**
     * @return array
     */
    public function dataProviderArticleCheck()
    {
        /** $oxid, $expected */
        return [
            ['123', '123'],
            [null, false],
        ];
    }

    /**
     * @dataProvider dataProviderArticleTitleCheck
     * @param $title
     * @param $expected
     */
    public function testArticleTitleCheck($title, $expected)
    {
        $unitTestController = $this->getMockBuilder($this->getProxyClassName(UnitTestController::class))
            ->setMethods(null)
            ->disableOriginalConstructor()
            ->getMock();

        $article = $this->getMockBuilder(Article::class)
            ->setMethods(['getTitle'])
            ->disableOriginalConstructor()
            ->getMock();

        $article->expects($this->once())
            ->method('getTitle')
            ->willReturn($title);

        $this->assertEquals($expected, $unitTestController->UNITarticleTitleCheck($article));
    }

    /**
     * @return array
     */
    public function dataProviderArticleTitleCheck()
    {
        return [
            ['oxid rules', 'oxid rules'],
            [null, false],
            [false, false],
        ];
    }

    /**
     * @param $configParam
     * @param $expected
     * @dataProvider dataProviderGetConfigParamForArticleOption
     */
    public function testGetConfigParamForArticleOption($configParam, $expected)
    {
        $unitTestController = $this->getMockBuilder($this->getProxyClassName(UnitTestController::class))
            ->setMethods(null)
            ->disableOriginalConstructor()
            ->getMock();
        $registry = $this->getMockBuilder(Registry::class)
            ->setMethods(null)
            ->disableOriginalConstructor()
            ->getMock();
        $config = $this->getMockBuilder(Config::class)
            ->setMethods(['getConfigParam'])
            ->disableOriginalConstructor()
            ->getMock();
        $registry->set(Config::class, $config);

        $config->expects($this->once())
            ->method('getConfigParam')
            ->with('testParam')
            ->willReturn($configParam);

        $this->assertEquals($expected, $unitTestController->getConfigParamForArticleOption());
    }

    /**
     * @return array
     */
    public function dataProviderGetConfigParamForArticleOption()
    {
        /** $configParam, $expected */
        return [
            [true, true],
            [false, false],
        ];
    }

    /**
     * @param $configParam1
     * @param $configParam2
     * @param $expected
     * @param $configParamCount
     * @dataProvider dataProviderGetMultipleConfigParams
     */
    public function testGetMultipleConfigParams($configParam1, $configParam2, $expected, $configParamCount)
    {
        $unitTestController = $this->getMockBuilder($this->getProxyClassName(UnitTestController::class))
            ->setMethods(null)
            ->disableOriginalConstructor()
            ->getMock();
        $registry = $this->getMockBuilder(Registry::class)
            ->setMethods(null)
            ->disableOriginalConstructor()
            ->getMock();
        $config = $this->getMockBuilder(Config::class)
            ->setMethods(['getConfigParam'])
            ->disableOriginalConstructor()
            ->getMock();
        $registry->set(Config::class, $config);

        $config->expects($this->exactly($configParamCount))
            ->method('getConfigParam')
            ->withConsecutive(['testParam1'], ['testParam2'])
            ->willReturnOnConsecutiveCalls($configParam1, $configParam2);

        $this->assertEquals($expected, $unitTestController->getMultipleConfigParams());
    }

    /**
     * @return array
     */
    public function dataProviderGetMultipleConfigParams()
    {
        /**
         * $configParam1, $configParam2, $expected, $configParamCount
         */
        return [
            [true, true, true, 2],
            [true, false, false, 2],
            [false, true, false, 1],
            [false, false, false, 1],
        ];
    }
}
