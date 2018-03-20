<?php

use test\Selenium;

class HelloTest extends Selenium {
	public function setUp()
    {
        parent::setUp();        
        $this->webDriver->get($this->startUrl);        
    }
    public function testHello() {
		 $linkText = 'hello';
		 $failMessage = "Text  not found " ;         
         $this->testCase->assertTrue($this->isElementPresent(\WebDriverBy::xpath(sprintf("(//*[text()='%s'])",$linkText))), $failMessage);       
        
    }
    
    protected function isElementPresent(\WebDriverBy $by)
    {        
        try {
            $element = $this->webDriver->findElement($by);  
            if($element->isDisplayed()){                   
                return true;
            }            
            return false;
        }
        catch (\Throwable  $e) {              
            return false;
        }
    }   
	
	}
