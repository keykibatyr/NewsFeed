<?php

namespace Facebook\WebDriver;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

require __DIR__ . '/../../vendor/autoload.php';


// $serverUrl = 'http://localhost:4444';

$driver = RemoteWebDriver::create('http://localhost:4444/',
 DesiredCapabilities::chrome());

$driver->get('http://localhost:80');

$driver->findElement(WebDriverBy::id('signin')) -> click(); // find search input element
    // ->sendKeys('') // fill the search box
    // ->submit(); // submit the whole form

// Find element of 'History' item in menu by its css selector
$driver->wait()->until(
    WebDriverExpectedCondition::elementTextContains(WebDriverBy::id('SignIn-Text'), 'Sign In')
);

sleep(2);

$driver -> findElement(WebDriverBy::id('email')) -> click() 
->sendKeys('asdasd@asdasd');

sleep(2);

$driver -> findElement(WebDriverBy::id('password')) -> click() 
->sendKeys('asdasd')
->submit();

sleep(2);

$driver->wait()->until(
    WebDriverExpectedCondition::elementTextContains(WebDriverBy::id('feed'), " ")
);

sleep(5);

$driver -> findElement(WebDriverBy::id('signout')) -> click();

sleep(5);

// Read text of the element and print it to output
// echo 'About to click to a button with text: ' . $historyButton->getText();

// // Click the element to navigate to revision history page
// $historyButton->click();

// Make sure to always call quit() at the end to terminate the browser session
$driver->quit();