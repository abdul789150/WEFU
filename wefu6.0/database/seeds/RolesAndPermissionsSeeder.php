<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Reset Cached Data first the add new permission and roles
        // here we will reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        
        // Now we wil seed new permission and roles in the database
        // Customer Permissions
        Permission::create(['name' => 'edit profile'])->save();
        Permission::create(['name' => 'add address'])->save();
        Permission::create(['name' => 'delete address'])->save();
        Permission::create(['name' => 'update address'])->save();
        Permission::create(['name' => 'place order'])->save();
        Permission::create(['name' => 'complete order'])->save();
        
        // Admin Permissions
        Permission::create(['name' => 'manage permissions'])->save();
        Permission::create(['name' => 'manage roles'])->save();
        Permission::create(['name' => 'create new member'])->save(); //new Staff, manager, admin etc.
        Permission::create(['name' => 'watch analytics'])->save();
        Permission::create(['name' => 'manage orders'])->save();
        Permission::create(['name' => 'manage shippment'])->save();


        // Adding Roles
        Role::create(['name' => 'customer'])
                ->givePermissionTo([
                    'edit profile', 'add address', 'delete address', 'update address',
                    'place order', 'complete order',
                ])->save();

        Role::create(['name' => 'admin'])
                ->givePermissionTo([
                    'edit profile', 'manage permissions', 'manage roles', 'create new member',
                    'watch analytics', 'manage orders', 'manage shippment',
                ])->save();
                





    }
}
