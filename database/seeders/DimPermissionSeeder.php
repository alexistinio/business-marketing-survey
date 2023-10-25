<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DimPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
        // Menu
        DB::table('dim_menus')->insert([
            [
                'id' => 1,
                'name' => 'home',
                'text' => 'Home',
                'status_id' => 1,
            ],
            [
                'id' => 2,
                'name' => 'messages',
                'text' => 'Messages',
                'status_id' => 1,
            ],
            [
                'id' => 3,
                'name' => 'notifications',
                'text' => 'Notifications',
                'status_id' => 1,
            ],
            [
                'id' => 4,
                'name' => 'groups',
                'text' => 'Groups',
                'status_id' => 1,
            ],
            [
                'id' => 5,
                'name' => 'profile',
                'text' => 'Profile',
                'status_id' => 1,
            ],
            [
                'id' => 6,
                'name' => 'about',
                'text' => 'About',
                'status_id' => 1,
            ],
            [
                'id' => 7,
                'name' => 'services',
                'text' => 'Services',
                'status_id' => 1,
            ],
            [
                'id' => 8,
                'name' => 'post',
                'text' => 'Post',
                'status_id' => 1,
            ],
            [
                'id' => 9,
                'name' => 'user_management',
                'text' => 'User Management',
                'status_id' => 1,
            ],
            [
                'id' => 10,
                'name' => 'survey',
                'text' => 'Survey',
                'status_id' => 1,
            ],

        ]);

        // Menu Permission
        DB::table('fct_menu_permission')->insert([
            [
                'id' => 1,
                'menu_id' => 1,
                'permission' => 'view',
                'name' => 'can_view_home',
                'text' => 'Can view home',
            ],
            [
                'id' => 2,
                'menu_id' => 1,
                'permission' => 'add',
                'name' => 'can_add_home',
                'text' => 'Can add home',
            ],
            [
                'id' => 3,
                'menu_id' => 1,
                'permission' => 'edit',
                'name' => 'can_edit_home',
                'text' => 'Can edit home',
            ],

            [
                'id' => 4,
                'menu_id' => 2,
                'permission' => 'view',
                'name' => 'can_view_messages',
                'text' => 'Can view messages',
            ],
            [
                'id' => 5,
                'menu_id' => 2,
                'permission' => 'add',
                'name' => 'can_add_messages',
                'text' => 'Can add messages',
            ],
            [
                'id' => 6,
                'menu_id' => 2,
                'permission' => 'edit',
                'name' => 'can_edit_messages',
                'text' => 'Can edit messages',
            ],

            [
                'id' => 7,
                'menu_id' => 3,
                'permission' => 'view',
                'name' => 'can_view_notifications',
                'text' => 'Can view notifications',
            ],
            [
                'id' => 8,
                'menu_id' => 3,
                'permission' => 'edit',
                'name' => 'can_edit_notifications',
                'text' => 'Can edit notifications',
            ],
            [
                'id' => 9,
                'menu_id' => 3,
                'permission' => 'add',
                'name' => 'can_add_notifications',
                'text' => 'Can add notifications',
            ],

            [
                'id' => 10,
                'menu_id' => 4,
                'permission' => 'view',
                'name' => 'can_view_group',
                'text' => 'Can view group',
            ],
            [
                'id' => 11,
                'menu_id' => 4,
                'permission' => 'add',
                'name' => 'can_add_group',
                'text' => 'Can add group',
            ],
            [
                'id' => 12,
                'menu_id' => 4,
                'permission' => 'edit',
                'name' => 'can_edit_group',
                'text' => 'Can edit group',
            ],

            [
                'id' => 13,
                'menu_id' => 5,
                'permission' => 'view',
                'name' => 'can_view_profile',
                'text' => 'Can view profile',
            ],
            [
                'id' => 14,
                'menu_id' => 5,
                'permission' => 'add',
                'name' => 'can_add_profile',
                'text' => 'Can add profile',
            ],
            [
                'id' => 15,
                'menu_id' => 5,
                'permission' => 'edit',
                'name' => 'can_edit_profile',
                'text' => 'Can edit profile',
            ],

            [
                'id' => 16,
                'menu_id' => 6,
                'permission' => 'view',
                'name' => 'can_view_about',
                'text' => 'Can view about',
            ],
            [
                'id' => 17,
                'menu_id' => 6,
                'permission' => 'add',
                'name' => 'can_add_about',
                'text' => 'Can add about',
            ],
            [
                'id' => 18,
                'menu_id' => 6,
                'permission' => 'edit',
                'name' => 'can_edit_about',
                'text' => 'Can edit about',
            ],

            [
                'id' => 19,
                'menu_id' => 7,
                'permission' => 'view',
                'name' => 'can_view_services',
                'text' => 'Can view services',
            ],
            [
                'id' => 20,
                'menu_id' => 7,
                'permission' => 'add',
                'name' => 'can_add_services',
                'text' => 'Can add services',
            ],
            [
                'id' => 21,
                'menu_id' => 7,
                'permission' => 'edit',
                'name' => 'can_edit_services',
                'text' => 'Can edit services',
            ],

            [
                'id' => 22,
                'menu_id' => 8,
                'permission' => 'view',
                'name' => 'can_view_post',
                'text' => 'Can view post',
            ],
            [
                'id' => 23,
                'menu_id' => 8,
                'permission' => 'add',
                'name' => 'can_add_apost',
                'text' => 'Can add post',
            ],
            [
                'id' => 24,
                'menu_id' => 8,
                'permission' => 'edit',
                'name' => 'can_edit_post',
                'text' => 'Can edit post',
            ],

            [
                'id' => 25,
                'menu_id' => 9,
                'permission' => 'view',
                'name' => 'can_view_user_management',
                'text' => 'Can view user management',
            ],
            [
                'id' => 26,
                'menu_id' => 9,
                'permission' => 'edit',
                'name' => 'can_edit_user_management',
                'text' => 'Can edit user management',
            ],
            [
                'id' => 27,
                'menu_id' => 9,
                'permission' => 'add',
                'name' => 'can_add_user_management',
                'text' => 'Can add user management',
            ],

            [
                'id' => 28,
                'menu_id' => 10,
                'permission' => 'view',
                'name' => 'can_view_survey',
                'text' => 'Can view Survey',
            ],
            [
                'id' => 29,
                'menu_id' => 10,
                'permission' => 'edit',
                'name' => 'can_edit_survey',
                'text' => 'Can edit Survey',
            ],

            [
                'id' => 30,
                'menu_id' => 10,
                'permission' => 'add',
                'name' => 'can_add_survey',
                'text' => 'Can add Survey',
            ],
        ]);

        DB::table('fct_menu_role_permission')->insert([
            [
                'role_id' => 1,
                'permission_id' => 1,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 2,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 3,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 4,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 5,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 6,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 7,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 8,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 9,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 10,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 11,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 12,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 13,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 14,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 15,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 16,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 17,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 18,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 19,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 20,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 21,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 22,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 23,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 24,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 25,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 26,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 27,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 28,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 29,
                'status_id' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 30,
                'status_id' => 1,
            ],
        ]);
    }
}
