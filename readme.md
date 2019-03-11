# IoT Platform
Generic Internet of Things platform for data collection. Devices can be registered with custom fields. Supports triggers, visualization through charts, floor maps and Google Maps.

## Table of contents
  * [Technology stack](#technology-stack)
  * [Features](#features)
    * [Overview](#overview)
    * [Devices](#devices)
      * [Device Fields](#device-fields)
      * [Device Settings](#device-settings)
      * [Device Triggers](#device-triggers)
      * [Device Data](#device-data)
    * [Charts](#charts)
      * [Edit Chart](#edit-chart)
      * [Single Field Chart](#single-field-chart)
      * [Multi Field Chart](#multi-field-chart)
    * [Usage](#usage)
      * [Request](#request)
      * [Response](#response)
      * [Error responses](#error-responses)
  * [Installation](#installation)

## Goal



## Technology stack
* [Laravel](https://laravel.com/) for website and RESTful API
* [MySQL](https://www.mysql.com/) database

Charts are powered by [Chart.js](https://www.chartjs.org/).

ESP8266 module was used for this project.

## Features
### Overview
Home page.

![](https://i.imgur.com/sloUzzm.png)

### Devices
List of devices.

![](https://i.imgur.com/42kp36Q.png)

#### Device Fields

Device fields are used as keys for sending data to the platform.

![](https://i.imgur.com/kcmkEtj.png)

#### Device Settings

Basic device configuration and settings.

![](https://i.imgur.com/ngkBfat.png)

#### Device Triggers

Triggers via email and webhook.

![](https://i.imgur.com/dUu61Xu.png)

#### Device Data

Browse device data.

![](https://i.imgur.com/W7b9UoX.png)

### Charts

Create charts.

![](https://i.imgur.com/r5H3Jc6.png)

#### Edit Chart

Edit chart and add fields to display on it.

![](https://i.imgur.com/6TU440A.png)

#### Single Field Chart

Example of single field chart.

![](https://i.imgur.com/H2v6tgu.png)

#### Multi Field Chart 

Examples of multi field charts.

![](https://i.imgur.com/mYVk2Vy.png)

![](https://i.imgur.com/DqyNdd3.png)

### Usage

#### Request

Example request

```
localhost:8000/data?api_key=SYKzfAmDjFjbGonBbIHWrucslNFN8nD1mnABYXfhDztjY
&temperature=50
&humidity=55
&pressure=101325
```

It is also possible to use additional parameters: `datetime` and `mac_address`.

#### Response

Example response

```js
{
  status: "success",
  read_time: 15,
  added: [
    "temperature",
    "humidity"
  ],
  not_added: [
    "pressure"
  ],
  triggers_activated: [
    {
      field: "temperature",
      min_value: "10.00",
      max_value: "40.00",
      email: "silvio.simunic@gmail.com",
      webhook_url: null
    }
  ]
}
```

#### Error Responses

* Missing api key.
* No values.
* Non existing api key.
* Non-numeric value for field name.

## Installation

* Install Apache, PHP7, MySQL and Composer
* Run `composer install` in root directory
* Create database using `iotplatform.sql`
* Configure `.env` file
* Run `php artisan serve ` in root directory
