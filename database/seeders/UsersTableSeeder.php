<?php

namespace Database\Seeders;

use App\Models\location;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Utility;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Artisan;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    use HasRoles;

    public function run()
    {
        Artisan::call('cache:forget spatie.permission.cache');
        Artisan::call('cache:clear');

        $arrPermissions = [
            'manage user',
            'create user',
            'edit user',
            'delete user'
        ];
        foreach($arrPermissions as $ap)
        {
            Permission::create(['name' => $ap]);
        }
        // Super admin
        $superAdminRole        = Role::create(
            [
                'name' => 'super admin',
                'created_by' => 0,
            ]
        );
        $superAdminPermissions = [
            'manage user',
            'create user',
            'edit user',
            'delete user',
        ];
        foreach($superAdminPermissions as $ap)
        {
            $permission = Permission::findByName($ap);
            $superAdminRole->givePermissionTo($permission);
        }
        $superAdmin = User::create(
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('1234'),
                'user_type' => 'super admin',
                'created_by' => 0,
            ]
        );
        $superAdmin->assignRole($superAdminRole);
        // company
        $companyRole        = Role::create(
            [
                'name' => 'company',
                'created_by' => $superAdmin->id,
            ]
        );

        $companyPermissions = [
            "manage location",
            "create location",
            "edit location",
            "delete location",
            "manage role",
            "create role",
            "edit role",
            "delete role",
            "manage client",
            "create client",
            "edit client",
            "delete client",
            "manage user",
            "create user",
            "edit user",
            "delete user",
            "manage assets",
            "create assets",
            "edit assets",
            "delete assets",
            "associate assets",
            "manage parts",
            "create parts",
            "edit parts",
            "delete parts",
            "manage pms",
            "create pms",
            "edit pms",
            "delete pms",
            "associate pms",
            "manage vendor",
            "create vendor",
            "edit vendor",
            "delete vendor",
            "associate vendor",
            "manage pos",
            "create pos",
            "edit pos",
            "delete pos",
            "associate pos",
            "manage wos",
            "create wos",
            "edit wos",
            "delete wos",
            "associate wos",
            "manage logtime",
            "create logtime",
            "edit logtime",
            "delete logtime",
        ];

        foreach($companyPermissions as $ap)
        {
            // check if permission is not created then create it.
            $permission = Permission::where('name', 'LIKE', $ap)->first();
            if(empty($permission))
            {
                Permission::create(['name' => $ap]);
            }
            
            $permission = Permission::findByName($ap);
            $companyRole->givePermissionTo($permission);
        }
        $company = User::create(
            [
                'name' => 'company',
                'email' => 'company@example.com',
                'password' => Hash::make('1234'),
                'user_type' => 'company',
                'created_by' => $superAdmin->id,
                'company_id' => 0
            ]
        );

        if($company){
            $company->assignRole($companyRole);

            $Location = location::create([
                'name' =>'location1',
                'address'=>'First Location',
                'slug'=>'First-location',
                'created_by'=>$company->id,
                'company_id'=>$company->id,
                'is_active'=>1,
    
            ]);

            if($Location)
            {
                $company->update(['location_id' => $Location->id, 'current_location' => $Location->id]);

            }
        }
        

        // add customfield for create assets info
        Utility::addCustomFields();
        Utility::add_landing_page_data();
    }
}
