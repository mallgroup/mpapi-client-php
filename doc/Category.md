# Category client

## Client initialization

To see example of initialization, please look at [Implementation](../README.md#implementation) part of our [README](../README.md)

## Get list of all categories

Method returns [CategoryIterator](../src/Category/Entity/CategoryIterator.php) containing [Category](../src/Category/Entity/Category.php) entity.

```php
use MpApiClient\Common\Interfaces\CategoryClientInterface;

/** @var CategoryClientInterface $categoryClient */
$categories = $categoryClient->list();
echo json_encode($categories, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
[
  {
    "category_id": "BB001",
    "title": "Big Brands - ostatní"
  },
  {
    "category_id": "EA001",
    "title": "Kuchyňské baterie"
  },
  {
    "category_id": "PR007",
    "title": "Doplňky"
  },
  ...
]
```

## Get parameters for specific category

Method returns [CategoryParameterIterator](../src/Category/Entity/ParameterIterator.php) containing [CategoryParameter](../src/Category/Entity/Parameter.php) entity.

```php
use MpApiClient\Common\Interfaces\CategoryClientInterface;

/** @var CategoryClientInterface $categoryClient */
$categoryParams = $categoryClient->getParameters('EA001');
echo json_encode($categoryParams, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
[
  {
    "categoryParamId": "SURFACE",
    "title": "Povrch",
    "unit": "",
    "values": [
      {
        "id": "BRON ELOX",
        "text": "bronzový elox"
      },
      {
        "id": "CHROME",
        "text": "chrom"
      },
      ...
    ]
  },
  {
    "categoryParamId": "LEVER",
    "title": "Páková",
    "unit": "",
    "values": [
      {
        "id": "YES",
        "text": "Ano"
      },
      {
        "id": "NO",
        "text": "Ne"
      },
      {
        "id": "N\/A",
        "text": "Výrobce neuvádí"
      }
    ]
  },
  {
    "categoryParamId": "LENGTH_SHOWER",
    "title": "Délka sprchy",
    "unit": "cm",
    "values": []
  },
  ...
]
```

## Get entire mall category tree

Method expects [ShopIdEnum](../src/Shop/Entity/ShopIdEnum.php) and returns [CategoryTreeItemIterator](../src/Category/Entity/TreeItemIterator.php)
containing [CategoryTreeItem](../src/Category/Entity/TreeItem.php).

```php
use MpApiClient\Common\Interfaces\CategoryClientInterface;
use MpApiClient\Shop\Entity\ShopIdEnum;

/** @var CategoryClientInterface $categoryClient */
$categoryTree = $categoryClient->tree(ShopIdEnum::CZ10MA());
echo json_encode($categoryTree, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
```

Example above prints out

```json
[
  {
    "title": "MALL"
    "categoryVisible": true,
    "items": [
      {
        "title": "Potraviny a nápoje",
        "categoryVisible": true,
        "items": [
          {
            "title": "Dárkové koše",
            "categoryVisible": true,
            "items": [],
            "menuItems": [
              {
                "menuItemId": 100058812,
                "title": "Pro děti",
                "categoryVisible": false,
                "sapCategories": [
                  {
                    "operator": "AND",
                    "menuConstraints": [
                      {
                        "paramId": "MEN_WOMEN_AND",
                        "operator": "=",
                        "value1": "pro děti",
                        "value2": null,
                        "class": 3
                      }
                    ],
                    "productTypeId": "NK184",
                    "segment": "MP"
                  }
                ],
                "url": "https://www.mall.cz/darkove-kose-pro-deti"
              },
              ...
            ]
          },
          ...
        ],
        "menuItems": []
      }
      ...
    ],
    "menuItems": []
  }
]
```

### See more examples [here](../example/Category.php)
