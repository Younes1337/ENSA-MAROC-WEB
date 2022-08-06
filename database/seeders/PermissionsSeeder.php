<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions_fields = [
            "e_n_s_a_s", "images", "messages", "clubs", "events",
            "specialities", "opportunities", "websites", "subscribers", "galleries",
            "news", "semesters", "modules", "phones", "elements", "courses"
        ];

        $rolesArray = ["admin", "moderator"];
        $permissions = ["create", "delete", "show", "list", "edit"];

        // create permissions
        foreach ($permissions_fields as $permission_field) {
            foreach (array_merge($permissions, ["users"]) as $permission) {
                Permission::create(['name' => $permission . " " . $permission_field]);
            }
        }

        // Assign permissions to roles
        foreach ($rolesArray as $role) {
            $role = Role::create(['name' => $role]);
            $role = $this::assignPermissions($permissions_fields, $permissions, $role);
        }

    }

    public static function assignPermissions($permissions_fields, $permissions, $role) {
        $permissions_fields = $role == "admin" ? array_merge($permissions_fields, ["users"]) : $permissions_fields;
        foreach ($permissions_fields as $table) {
            foreach ($permissions as $permission) {
                $role->givePermissionTo($permission . " " . $table);
            }
        }
        return $role;
    }
}
