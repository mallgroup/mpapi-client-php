# Marketplace API client - change log
## 2.3.0
- Move products entities into Products namespace.
- Add method for remove used filter.
- Added two types of variants list (ids and basic). If you want get list with basic data you can use filter 'basic'. Filter 'ids' is default.
- Variants service GET now returns three types of object 'array', 'Variant', 'BasicVariantIterator'.

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