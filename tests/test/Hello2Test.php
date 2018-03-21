<?php

use PHPUnit\Framework\TestCase;

class Hello2Test extends TestCase {

    protected $webDriver;
    protected $startUrl;

    public function setUp() {
        $options = new \ChromeOptions();
        $options->addArguments(array(
            '--window-size=1324,768',
        ));
        $caps = \DesiredCapabilities::chrome();
        $caps->setCapability(\ChromeOptions::CAPABILITY, $options);
        $this->webDriver = \RemoteWebDriver::create('http://localhost:4444/wd/hub', $caps);
        $this->webDriver->manage()->timeouts()->implicitlyWait(10);
        //$this->startUrl = "http://testsel.dz/manager/";
        $this->startUrl = "http://manager/";
        $this->webDriver->get($this->startUrl);
    }

    public function testHello() {
        $linkText = 'Hello';
        $failMessage = "Text  not found ";        
        $this->assertTrue($this->isElementPresent(\WebDriverBy::xpath(sprintf("(//*[text()='%s'])", $linkText))), $failMessage);
    }

    protected function isElementPresent(\WebDriverBy $by) {
        try {
            $element = $this->webDriver->findElement($by);
            if ($element->isDisplayed()) {                
                return true;
            }
            return false;
        } catch (\Throwable $e) {            
            return false;
        }
    }

    public function tearDown() {
        $this->webDriver->quit();
    }

}
