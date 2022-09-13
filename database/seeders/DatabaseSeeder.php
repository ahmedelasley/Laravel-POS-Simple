<?php

namespace Database\Seeders;

// use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $role = Role::create([
            'name' => 'مالك البرنامج'
        ]);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        // \App\Models\User::factory(10)->create();

        // for ($i = 1; $i <= 94; $i++) {
        //     Product::create([
        //         'barcode' => rand(100, 100000),
        //         'name' => Str::random(10),
        //         'description' => Str::random(50),
        //         'cost_price' => rand(5500, 7500),
        //         'selling_price' => rand(8000, 10500),
        //         'quantity' => rand(5,30),
        //         'picture' => 'uploads/images/product ('.$i.').jpg',
        //         'category_id' => 1,
        //         'supplier_id' => 1,
        //         'user_id' => 1,
        //     ]);
        // }
    }
}
