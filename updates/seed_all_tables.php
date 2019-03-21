<?php namespace Prismify\Pipeline\Updates;

use October\Rain\Database\Updates\Seeder;
use Prismify\Pipeline\Models\Pipeline;

class SeedAllTables extends Seeder
{
    public function run()
    {
        /*
         * Pipelines
         */
        if (Pipeline::count() > 0) {
            return;
        }

        Pipeline::insert([
            [
                'name' => 'Sales Pipeline',
                'code' => 'SALES',
                'is_enabled' => 1,
            ],
            [
                'name' => 'Support Pipeline',
                'code' => 'SUPPORT',
                'is_enabled' => 1,
            ],
            [
                'name' => 'Other Pipeline',
                'code' => 'OTHER',
                'is_enabled' => 0,
            ]
        ]);

        $sales = Pipeline::whereCode('SALES')->first();
        $sales->stages()->createMany([
            ['name' => 'Appointment Scheduled'],
            ['name' => 'Qualified To Buy'],
            ['name' => 'Presentation Scheduled'],
            ['name' => 'Decision Maker Bought-In'],
            ['name' => 'Contract Sent'],
            ['name' => 'Closed Won'],
            ['name' => 'Closed Lost'],
        ]);

        $support = Pipeline::whereCode('SUPPORT')->first();
        $support->stages()->createMany([
            ['name' => 'New'],
            ['name' => 'Waiting on contact'],
            ['name' => 'Waiting on us'],
            ['name' => 'Closed'],
        ]);
    }
}