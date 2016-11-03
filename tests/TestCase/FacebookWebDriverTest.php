<?php
/**
 * Created by PhpStorm.
 * User: Hirokazu
 * Date: 2016/10/11
 * Time: 9:51
 */

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

class FacebookWebDriverTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var RemoteWebDriver
     */
    protected $webDriver;
    protected $url = 'https://getcomposer.org/';

    public function setUp()
    {
        //$capabilities = array(WebDriverCapabilityType::BROWSER_NAME => 'firefox');
        //$this->webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);
        $this->webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub', DesiredCapabilities::firefox());
    }

    public function testComposerTitle()
    {
        $this->webDriver->get($this->url);
        // checking that page title contains word 'Composer'
        $this->assertContains('Composer', $this->webDriver->getTitle());
        // スクリーンショット取得
        $this->webDriver->takeScreenshot('img/' . 'composer.png');
    }

    public function testIndexTitle()
    {
        $this->webDriver->get('http://localhost/phpunit_study/unittest/app/');
        $this->assertContains('Test', $this->webDriver->getTitle());
        // スクリーンショット取得
        $this->webDriver->takeScreenshot('img/' . 'title.png');
    }

    public function tearDown()
    {
        $this->webDriver->quit();
    }
}