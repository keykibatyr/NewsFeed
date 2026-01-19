<?php

namespace Facebook\WebDriver;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

require __DIR__ . '/../../vendor/autoload.php';


// $serverUrl = 'http://localhost:4444';

$driver = RemoteWebDriver::create('http://localhost:4444/',
 DesiredCapabilities::chrome());

$driver->get('http://localhost:80');

$driver->findElement(WebDriverBy::id('signup')) -> click(); // find search input element
    // ->sendKeys('') // fill the search box
    // ->submit(); // submit the whole form

sleep(2);

$driver->wait()->until(
    WebDriverExpectedCondition::elementTextContains(WebDriverBy::id('SignUp-Text'), 'Create an Account')
);

sleep(2);

$driver -> findElement(WebDriverBy::id('name')) -> click() 
->sendKeys('Alitrvgrfrb');

sleep(2);

$driver -> findElement(WebDriverBy::id('email')) -> click() 
->sendKeys('asdasd@abtrewrb');

sleep(2);

$driver -> findElement(WebDriverBy::id('password')) -> click() 
->sendKeys('asdasdasdasd');

sleep(2);

$driver -> findElement(WebDriverBy::id('submit')) -> click();

sleep(2);

$driver->wait()->until(
    WebDriverExpectedCondition::elementTextContains(WebDriverBy::id('feed'), "")
);

sleep(2);

$driver -> findElement(WebDriverBy::id('signout')) -> click();


// Read text of the element and print it to output
// echo 'About to click to a button with text: ' . $historyButton->getText();

// // Click the element to navigate to revision history page
// $historyButton->click();

// Make sure to always call quit() at the end to terminate the browser session
$driver->quit();