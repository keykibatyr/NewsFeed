Here is a cleaner, professional, and structured version of your README, keeping it concise and correct.

---

# NewsFeed Project (PHP)

## Tech Stack

* **Backend:** PHP
* **Frontend:** HTML / CSS
* **Database:** MySQL
* **E2E Tests:** Selenium + PHP WebDriver
* **Containerization:** Docker
* **DB UI:** Adminer

---

## Project Setup

All commands must be executed from the project root:

```bash
cd news-feed-proj
```

### Install Dependencies (macOS)

```bash
brew install php
brew install composer
```

Install PHP WebDriver:

```bash
composer require php-webdriver/webdriver:^1.15
```

---

## Database

* Database runs in Docker
* Adminer available at: **[http://localhost:3333](http://localhost:3333)**
* Tables can be created using SQL files from:

```
migrations/sql
```

You may assign yourself the **admin role** directly via Adminer.

---

## Selenium E2E Tests

### 1. Download ChromeDriver

Download the **ChromeDriver version matching your Google Chrome version**:
[https://sites.google.com/chromium.org/driver/downloads](https://sites.google.com/chromium.org/driver/downloads)

Ensure `chromedriver` is available in your PATH.

---

### 2. Download Selenium Server

Download **Selenium Server v4.39.0** (from *Previous releases*):
[https://www.selenium.dev/downloads/](https://www.selenium.dev/downloads/)

---

### 3. Start Selenium Server

```bash
java -jar selenium-server-4.39.0.jar standalone
```

---

### 4. Run Tests

After Selenium is running, execute the test files located in:

```
tests/e2e
```

---

## Notes

* Docker must be running before starting the project
* Chrome, ChromeDriver, and Selenium versions **must be compatible**
* Tests assume a running backend and database

---
