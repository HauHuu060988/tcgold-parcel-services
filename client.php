<?php

require_once __DIR__ . '/vendor/autoload.php';

use Tcgold\Service\Parcel;

$modelList = [1, 2, 4];
$faker = Faker\Factory::create();
$parcel = new Parcel();

/* Get JWT For Authorization */
$rsRegister = $parcel->register(['username' => $faker->userName]);

echo "---------- GET JWT ----------\n";
var_dump($rsRegister);

if ($rsRegister['httpCode'] == 200) {
    $jwt = $rsRegister['data']['jwt'];

    /* Create Parcel */
    $parcelData = [
        'name' => $faker->sentence(2),
        'weight' => $faker->randomFloat(2, 0, 10),
        'volume' => $faker->randomFloat(5, 0, 0.001),
        'value' => $faker->randomFloat(0, 1, 1000),
        'model' => $faker->randomElement($modelList),
    ];
    $rsCreateParcel = $parcel->createParcel($jwt, $parcelData);
    $parcelID = $rsCreateParcel['data']['id'];
    echo "---------- Create Parcel ----------\n";
    var_dump($rsCreateParcel);

    /* Get Parcel */
    $rsGetParcel = $parcel->getParcel($jwt, $parcelID);
    echo "---------- Get Parcel ----------\n";
    var_dump($rsGetParcel);

    /* Update Parcel */
    $parcelData = [
        'name' => $faker->sentence(2),
        'weight' => $faker->randomFloat(2, 0, 10),
        'volume' => $faker->randomFloat(5, 0, 0.001),
        'value' => $faker->randomFloat(0, 1, 1000),
        'model' => $faker->randomElement($modelList),
    ];
    $rsUpdateParcel = $parcel->updateParcel($jwt, $parcelID, $parcelData);
    echo "---------- Update Parcel ----------\n";
    var_dump($rsUpdateParcel);

    /* Calculate Parcels */
    $parcelIDlist = [1, 2, 3, $parcelID];
    $params = [
        'parcelIds' => implode(',', $parcelIDlist),
    ];
    $rsCalculateParcels = $parcel->calculateParcels($jwt, $params);
    echo "---------- Calculate Parcels ----------\n";
    var_dump($rsCalculateParcels);

    /* Delete Parcel */
    $rsDeleteParcel = $parcel->deteleParcel($jwt, $parcelID);
    echo "---------- Delete Parcel ----------\n";
    var_dump($rsDeleteParcel);
}

