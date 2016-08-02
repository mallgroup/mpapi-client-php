## CATEGORIES

### Available methods:
**GET**  
This service have only one method, this method provides list of available categories.
```
<?php 
...
use MPAPI\Services\Categories;

...

$categories = new Categories($mpapiClient);
...
``` 

#### All partner categories
Get all categories available  for the partner.  
```
...
$response = $categories->get()->categories(); 
... 
```

The response contains array of available categories:
```
 [
   [
    "title" => "Category 1 - title",
    "category_id" => "MPCAT01"
  ],
  [
    "title" => "MP Category 2 - title",
    "category_id" => "MPCAT01"
  ],
  ...
]

```

#### Search category by prefix
Search categories by title prefix:
```
...
$response = $categories->get()->categoriesByPrefix('Categ'); 
... 
```

The response contains an array of found categories:
```
 [
   [
    "title" => "Category 1 - title",
    "category_id" => "MPCAT01"
  ],
  ...
]

```

#### Search in categories
Search categories by phrase in title:
```
...
$response = $categories->get()->searchCategories('gory'); 
... 
```

The response contains an array of found categories:
```
 [
   [
    "title" => "Category 1 - title",
    "category_id" => "MPCAT01"
  ],
  [
    "title" => "MP Category 2 - title",
    "category_id" => "MPCAT01"
  ],
  ...
]

```

#### Get all category parameters
Get all available parameters for specific category:
```
...
$response = $categories->get()->categoryParameters('MPCAT01'); 
... 
```

The response contains an array of found parameters:
```
 [
  [
    "title" => "Barva",
    "param_id" => "MP_COLOR"
  ],
  [
    "title" => "Velikost",
    "param_id" => "MP_SIZE"
  ],
  [
    "title" => "Určení produktu",
    "param_id" => "MP_DETERMINATION_PRODUCT"
  ]
  ...
]

```

##### See more:
> **/root/vendor/mallgroup/mpapi-client/Example/CategoriesExample.php**