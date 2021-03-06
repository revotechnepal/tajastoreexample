<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class OrderStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->insert(array (
            0 =>
            array (
                'id' => 1,
                'status' => 'Order Received',
                'created_at' => '2019-08-30 16:39:28',
                'updated_at' => '2019-10-15 18:03:14',
            ),
            1 =>
            array (
                'id' => 2,
                'status' => 'Order Processing',
                'created_at' => '2019-10-15 18:03:50',
                'updated_at' => '2019-10-15 18:03:50',
            ),
            2 =>
            array (
                'id' => 3,
                'status' => 'Ready',
                'created_at' => '2019-10-15 18:04:30',
                'updated_at' => '2019-10-15 18:04:30',
            ),
            3 =>
            array (
                'id' => 4,
                'status' => 'On the Way',
                'created_at' => '2019-10-15 18:04:13',
                'updated_at' => '2019-10-15 18:04:13',
            ),
            4 =>
            array (
                'id' => 5,
                'status' => 'Delivered',
                'created_at' => '2019-10-15 18:04:30',
                'updated_at' => '2019-10-15 18:04:30',
            ),
            5 =>
            array (
                'id' => 6,
                'status' =>'Canceled',
                'created_at' => '2019-10-15 18:04:30',
                'updated_at' => '2019-10-15 18:04:30',
            )

        ));
    }
}
