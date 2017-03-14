# Marketplace API client - change log

## 2.3.7
- added endpoints for the get list of orders by status

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