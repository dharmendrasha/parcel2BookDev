<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\offerTableModel;
use Faker\Generator as Faker;

$factory->define(offerTableModel::class, function (Faker $faker) {
    return [
        'companyName' => $faker->name,
        'companyLogo' => "https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.fujitsu-general.com%2F&psig=AOvVaw0IVHU7Z5aJ2Sy6ch5eXiYd&ust=1585159286237000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCNitrNXYs-gCFQAAAAAdAAAAABAD",
        'valeWithProtection' => uniqid(),
        'valueWithoutProtection' => uniqid(),
        'areaCoverArray' => uniqid()
    ];
});
