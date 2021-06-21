## Installation

This library can be installed with [Composer](https://getcomposer.org/). Run this command:
```php
composer require tcgold/service
```
## How To Use (refer to file client.php)

**Import Autoload** 
```php
require_once __DIR__ . '/vendor/autoload.php';
```

**Initialization**
```php
use Tcgold\Service\Parcel;
$parcel = new Parcel();
```

**Register**
>Get Access Token for all parcle services
```php
$payload= ['username' => $username];
$rsRegister = $parcel->register($payload);
$jwt = $rsRegister['data']['jwt'];
```

**Create Parcel**
>The value of $model must be in the list [1,2,4]
>>1: MODEL_BY_WEIGHT
>>2: MODEL_BY_VOLUME
>>4: MODEL_BY_VALUE
```php
$parcelData = [
    'name' => $name,
    'weight' => $weight,
    'volume' => $volume,
    'value' => $value,
    'model' => $model,
];
$rsCreateParcel = $parcel->createParcel($jwt, $parcelData);
```

**Get Parcel**
```php
$rsGetParcel = $parcel->getParcel($jwt, $parcelID);
```

**Update Parcel**
>The value of $model must be in the list [1,2,4]
>>1: MODEL_BY_WEIGHT
>>2: MODEL_BY_VOLUME
>>4: MODEL_BY_VALUE
```php
$parcelData = [
    'name' => $name,
    'weight' => $weight,
    'volume' => $volume,
    'value' => $value,
    'model' => $model,
];
$rsUpdateParcel = $parcel->updateParcel($jwt, $parcelID, $parcelData);
```

**Calculate Parcels**
```php
$parcelIDlist = [$parcelID1, $parcelID2, $parcelID3];
    $params = [
        'parcelIds' => implode(',', $parcelIDlist),
    ];
$rsCalculateParcels = $parcel->calculateParcels($jwt, $params);
```

**Delete Parcel**
```php
 $rsDeleteParcel = $parcel->deteleParcel($jwt, $parcelID);
```

## License
This project is licensed under the MIT License.
