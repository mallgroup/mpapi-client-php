## LABELS


#### Available methods:
**GET**  
This service has only one method that provides list of all available labels.
```
<?php 
...
use MPAPI\Services\Labels;

...

$labels = new Labels($mpapiClient); 
// Get all available labels
$response = $labels->get(); 
... 
```

The response contains an array of all available labels:
```
[
  [
    "id" => "LBLID1",
    "title" => "Label ID 1 - title"
  ],
  [
    "id" => "LBLID1",
    "title" => "Label ID 2 - title"
  ]
  ...
]
```

##### Example
> **/root/vendor/mallgroup/mpapi-client/Example/LabelsExample.php**