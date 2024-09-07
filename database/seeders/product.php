<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class product extends Seeder
{
    public function run(): void
    {
        $filePath = base_path('public/json_datas/products.json');
        Log::warning(File::exists($filePath));

        if (!File::exists($filePath)) {
            Log::error("File does not exist at path: " . $filePath);
            return;
        }

        $contents = File::get($filePath);
        $datas = json_decode($contents, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('Error decoding JSON: ' . json_last_error_msg());
            return;
        }

        $product_data = [];
        $mapping_data = [];
        $brand_data = [];

        foreach ($datas as $data) {
            foreach ($data as $items) {
                foreach ($items as $item) {
                    $unique_id = uniqid(). "-pid";

                    // Ensure attributes and variants are JSON encoded
                    $attributes = isset($item['attributes']) ? json_encode($item['attributes']) : json_encode([]);
                    $variants = isset($item['variants']) ? json_encode($item['variants']) : json_encode([]);
                    $images = isset($item['images']) ? json_encode($item['images']) : json_encode([]);

                    $each = [
                        'product_id' => $unique_id,
                        'mrp' => random_int(1000, 10000),
                        'category_code' => $item['category_code'] ?? null,
                        'sub_category_code' => $item['sub_category_code'] ?? null,
                        'product_code' => $item['product_code'] ?? null,
                        'brand_code' => $item['brand_code'] ?? null,
                        'name' => $item['name'] ?? null,
                        'images' => $images,
                        'image_base_path' => "/products/{$unique_id}",
                        'variants' => $variants,
                        'attributes' => $attributes,
                        'offer_value' => $item['discount'] ?? null,
                        'offer_type' => $item['discount_type'] ?? null,
                    ];
                    DB::table('products')->insert($each);
                    $product_data[] = $each;

                    if(!DB::table('master_mappings')->select('id')->where(['category_code'=>$item['category_code'],'sub_category_code'=>$item['sub_category_code'],'product_code'=>$item['product_code']])->exists()){
                        $mapp = [
                            'category_code' => $item['category_code'] ?? null,
                            'category' => ucwords(str_replace('_', ' ', $item['category_code'] ?? '')),
                            'sub_category_code' => $item['sub_category_code'] ?? null,
                            'sub_category' => ucwords(str_replace('_', ' ', $item['sub_category_code'] ?? '')),
                            'product_code' => $item['product_code'] ?? null,
                            'product' => ucwords(str_replace('_', ' ', $item['product_code'] ?? '')),
                            'variants' => $variants,
                            'attributes' => $attributes,
                            'created_by' => 'vishnu@gmail.com',
                            'updated_by' => 'vishnu@gmail.com',
                            'created_at' => now(), // Adjust as needed
                            'updated_at' => now(), // Adjust as needed
                        ];
                        DB::table('master_mappings')->insert($mapp);
                    }
                    // $mapping_data[] = $mapp;

                    if(!DB::table('master_brands')->select('id')->where('brand_code',$item['brand_code'])->exists()){
                        $brand = [
                            'brand_code' => $item['brand_code'] ?? null,
                            'brand' => ucwords(str_replace('_', ' ', $item['brand_code'] ?? '')),
                            'created_by' => 'vishnu@gmail.com',
                            'updated_by' => 'vishnu@gmail.com',
                            'created_at' => now(), // Adjust as needed
                            'updated_at' => now(), // Adjust as needed
                        ];
                        DB::table('master_brands')->insert($brand);
                    }
                    // $brand_data[] = $brand;
                }
            }
        }
    }
}
