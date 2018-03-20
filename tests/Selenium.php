<?php

namespace test;

use PHPUnit\Framework\TestCase;
/**
 * Class Test
 * @package VM\Test\Selenium
 * java -Dwebdriver.chrome.driver=/usr/local/bin/chromedriver -jar selenium-server-standalone-3.8.1.jar -debug
 */
class Selenium extends TestCase
{
    /**
     * @var \WebDriver
     */
    protected $webDriver;
    protected $startUrl;

    public function setUp()
    {
        $options = new \ChromeOptions();
        $options->addArguments(array(
            '--window-size=1324,768',
        ));
        $caps = \DesiredCapabilities::chrome();
        $caps->setCapability(\ChromeOptions::CAPABILITY, $options);
        $this->webDriver = \RemoteWebDriver::create('http://localhost:4444/wd/hub', $caps);
        $this->webDriver->manage()->timeouts()->implicitlyWait(10);
        $this->startUrl = "http://manager/";
    }

    public function tearDown()
    {
        $this->webDriver->quit();
    }

}
