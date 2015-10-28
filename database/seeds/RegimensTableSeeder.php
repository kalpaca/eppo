<?php

use Illuminate\Database\Seeder;

class RegimensTableSeeder extends Seeder {

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('regimens')->delete();

        $tasks = array(
            ['id' => 1, 'name' => 'capecitabine , gemcitabine', 'code' => 'CAPEGEMC', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 2, 'name' => 'mitotane', 'code' => 'MTTN', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 3, 'name' => 'capecitabine', 'code' => 'CAPE', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 4, 'name' => 'capecitabine , trastuzumab', 'code' => 'CAPE+TRAS', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 5, 'name' => 'epirubicin, cisplatin, capecitabine', 'code' => 'ECX', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 6, 'name' => 'imatinib', 'code' => 'IMAT', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 7, 'name' => 'dexamethasone', 'code' => 'DEXA(HD)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );

        //// Uncomment the below to run the seeder
        DB::table('regimens')->insert($tasks);
    }

}