# Marketplace API client - change log

## 2.11.0
- changed variant media switch to string; now is media tied to variable parameters; put one of the variable parameters

## 2.10.0
- extended order detail and orders basic data with customer ID

## 2.9.0
- extended product and variant entity with option 'free delivery' that sets delivery price to zero for the whole purchase where it is contained
- added 'payment_type' info into order detail

## 2.8.0
- endpoint GET order extended with 'stats' method that provides order statistics

## 2.7.0
- added new endpoint parameter values to categories

## 2.6.0
- updated composer - moved monolog logger to required-dev dependencies
- updated order endpoints - enabled filtering to get either list of ids or list of basic data for each status

## 2.5.0
- extended variant media with 'switch', that marks media as variant color switch (method addMedia has been extended with optional parameter 'switch')
- changed Product/Variant entity method addMedia; second parameter 'main' is now optional and default value is false

## 2.4.0
- added endpoints to get list of orders by all kinds of order statuses

## 2.3.6
- added tracking number to order detail

## 2.3.5
- Bug fix: warnings in object iterator

## 2.3.4
- Bug fix: access to pickup point dimensions

## 2.3.3
- implemented data collector for product list; key 'ids' has been removed from response structure and the list of product ids is returned directly to the output

## 2.3.2
-  removed developer's URL from config

## 2.3.1
- in services the access type of client object has been changed to protected

## 2.3.0
- moved products entities into Products namespace
- added method to remove used filter
- added two types of variant lists ('ids' and 'basic'). To get list with basic data you can use filter 'basic'. Filter 'ids' is set as default.
- variants service GET returns three types of return type: 'array', 'Variant', 'BasicVariantIterator'

## 2.2.1
- fix basic product data get status

## 2.2.0
- added filtering to **Product list** to offer more data for each product
- if you need more product data in the list, you can use filters to switch response data structure

## 1.0
- Easy to use - put client id an start using
- setup new public URL
- Based on [guzzle/guzzle](https://github.com/guzzle/guzzle), [Seldaek/monolog](https://github.com/Seldaek/monolog)
- Using [Codeception](https://github.com/Codeception/Codeception) for testing