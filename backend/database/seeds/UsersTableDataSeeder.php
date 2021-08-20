<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Module;
use App\Models\Setting;
use App\Models\Submodule;
use App\Models\Company;
use App\Models\Page;
use App\Models\Role;
use App\Models\RolePage;
use App\Models\UserUsergroup;
use App\Models\Usergroup;
use App\Models\UsergroupRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class UsersTableDataSeeder extends Seeder {

    /**
     * Run the database seeds/
     *
     * @return void
     */
    public function run() {

        // Truncate DB
        $ignoredTableList = [
            'oauth_access_tokens',
            'oauth_auth_codes',
            'oauth_clients',
            'oauth_personal_access_clients',
            'oauth_refresh_tokens'
        ];
        DB::statement("SET foreign_key_checks=0");
        $databaseName = DB::getDatabaseName();
        $tables = DB::select("SELECT * FROM information_schema.tables WHERE table_schema = '$databaseName'");
        foreach ($tables as $table) {
            $name = $table->TABLE_NAME;
            //if you don't want to truncate migrations
            if ($name == 'migrations' || in_array($name, $ignoredTableList)) {
                continue;
            }
            DB::table($name)->truncate();
        }
        DB::statement("SET foreign_key_checks=1");


        // Raw data insertion start from here/////

        $userTable[] = [
            'name' => "ssadmin",
            'company_id'=>1,
            'email' => "ssadmin@admin.com",
            'permission_version' => 0,
            'permissions'=>null,
            'password' => app('hash')->make('123456'),
            'created_at'=>\Carbon\Carbon::now()
        ];
        $userTable[] = [
            'name' => "Imran Hossain",
            'company_id'=>2,
            'email' => "imrancse94@gmail.com",
            'permission_version' => 0,
            'permissions'=>null,
            'password' => app('hash')->make('123456'),
            'created_at'=>\Carbon\Carbon::now()
        ];



        $companies = "INSERT INTO `companies` (`id`, `name`, `email`, `created_at`, `updated_at`) VALUES
                        (1, 'default', '','2015-11-04 10:52:01', '2015-11-04 10:52:01'),
                        (2, 'Imran Hossain','imrancse94@gmail.com','2019-03-28 00:47:10', '2019-03-28 00:47:10');";

        $roles = "INSERT INTO `roles` (`id`, `title`, `status`, `company_id`, `created_at`, `updated_at`) VALUES
                    (1, 'super-super-admin', 1, 1, '2019-03-28 07:37:17', '2019-03-28 01:37:17'),
                    (2, 'ADMIN_ROLE', 1, 2, '2019-03-28 00:47:11', '2019-03-28 00:47:11');";

$module_submodule_permission = "INSERT INTO `menu_submenu_permissions` (`id`,`parent_id`,`is_index`,`permission_name`, `name`, `icon`, `created_at`, `updated_at`) VALUES
                                (1, 0, 0,null,'Company', 'fa fa-list-ul', '2015-12-09 22:10:46', '2019-03-21 06:52:50'),
                                (2, 1, 1,'company-index','Company Management', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-21 06:52:50'),
                                (3, 2, 0,'company-add','Add New Company', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-21 06:52:50'),
                                (4, 2, 0,'company-edit','Modify Company', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-21 06:52:50'),
                                (5, 2, 0,'company-delete','Delete Company', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-21 06:52:50'),
                                (6, 2, 0,'company-view','View Company', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-21 06:52:50'),
                                (7, 0, 0,null,'Master Data', 'fa fa-list-ul', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (8, 7, 1,'module-index','Module Management', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (9, 8, 0,'module-add','Add New Module', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (10, 8, 0,'module-edit','Modify Module', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (11, 8, 0,'module-delete','Delete Module', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (13, 8, 0,'module-view','View Module', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (14, 7, 1,'submodule-index','Sub Module Management', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (15, 14, 0,'submodule-add','Add New Sub Module', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (16, 14, 0,'submodule-edit','Modify Sub Module', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (17, 14, 0,'submodule-delete','Delete Sub Module', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (18, 14, 0,'submodule-view','View Sub Module', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (19, 7, 1,'page-index','Page Management', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (20, 19, 0,'page-add','Add New Page', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (21, 19, 0,'page-edit','Modify Page', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (22, 19, 0,'page-delete','Delete Page', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (23, 19, 0,'page-view','View Page', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (24, 0, 0,null,'Access Control', 'fa fa-list-ul', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (25, 24, 1,'user-index','User List', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (26, 25, 0,'user-add','Add New User', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (27, 25, 0,'user-edit','Modify User', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (28, 25, 0,'user-delete','Delete User', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (29, 25, 0,'user-view','View User', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (30, 24, 1,'role-index','Role List', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (31, 30, 0,'role-add','Add New Role', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (32, 30, 0,'role-edit','Modify Role', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (33, 30, 0,'role-delete','Delete Role', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (34, 24, 1,'uesrgroup-index','Usergroup List', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (35, 34, 0,'uesrgroup-add','Add New Usergroup', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (36, 34, 0,'uesrgroup-edit','Modify Usergroup', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (37, 34, 0,'uesrgroup-delete','Delete Usergroup', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (38, 24, 1,'uesrgroup-role-assoc','Usergroup & Role Association', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (39, 24, 1,'role-page-assoc','Role & Page Association', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (40, 0, 0,null,'Configuration', 'fa fa-list-ul', '2015-12-09 22:10:46', '2019-03-27 23:03:33'),
                                (41, 40, 1,'site-settings','Site Settings', 'fa fa-angle-double-right', '2015-12-09 22:10:46', '2019-03-27 23:03:33')";

        $role_menu_submenu_permission = "INSERT INTO `role_menu_submenu_permissions` (`id`, `role_id`, `menu_submenu_permission_id`) VALUES
                                        (1, 1, 1),
                                        (2, 1, 2),
                                        (3, 1, 3),
                                        (4, 1, 4),
                                        (5, 1, 5),
                                        (6, 1, 6),
                                        (7, 1, 7),
                                        (8, 1, 8),
                                        (9, 1, 9),
                                        (10, 1, 10),
                                        (11, 1, 11),
                                        (12, 1, 12),
                                        (13, 1, 13),
                                        (14, 1, 14),
                                        (15, 1, 15),
                                        (16, 1, 16),
                                        (17, 1, 17),
                                        (18, 1, 18),
                                        (19, 1, 19),
                                        (20, 1, 20),
                                        (21, 1, 21),
                                        (22, 1, 22),
                                        (23, 1, 23),
                                        (24, 1, 24),
                                        (25, 1, 25),
                                        (26, 1, 26),
                                        (27, 1, 27),
                                        (28, 1, 28),
                                        (29, 1, 29),
                                        (30, 1, 30),
                                        (31, 1, 31),
                                        (32, 1, 32),
                                        (33, 1, 33),
                                        (34, 1, 34),
                                        (35, 1, 35),
                                        (36, 1, 36),
                                        (37, 1, 37),
                                        (38, 1, 38),
                                        (39, 1, 39),
                                        (40, 1, 40),
                                        (41, 1, 41);";

        $usergroups = "INSERT INTO `usergroups` (`id`, `name`, `status`, `company_id`, `created_at`, `updated_at`) VALUES
                        (1, 'super-super-admin-group', 1, 1, '2019-03-22 11:38:12', '2015-11-09 23:17:00'),
                        (2, 'ADMIN_USERGROUP', 1, 2, '2019-03-28 00:47:11', '2019-03-28 00:47:11');";

        $usergroupRole = "INSERT INTO `usergroup_roles` (`id`, `usergroup_id`, `role_id`, `company_id`) VALUES
                            (1, 1, 1, 1),
                            (2, 2, 2, 2);";

        $userUserGroup = "INSERT INTO `user_usergroups` (`id`, `usergroup_id`, `user_id`, `company_id`, `created_at`, `updated_at`) VALUES
                            (4, 2, 1, 2, '2019-03-28 00:47:11', '2019-03-28 00:47:11'),
                            (5, 1, 1, 2, '2019-03-28 02:56:23', '2019-03-28 02:56:23'),
                            (6, 1, 1, 2, '2019-03-28 03:12:13', '2019-03-28 03:12:13'),
                            (7, 1, 1, 2, '2019-03-28 03:13:20', '2019-03-28 03:13:20'),
                            (8, 2, 1, 2, '2019-03-30 03:11:57', '2019-03-30 03:11:57'),
                            (9, 2, 1, 2, '2019-03-30 03:13:42', '2019-03-30 03:13:42'),
                            (10, 2, 1, 2, '2019-03-30 05:39:26', '2019-03-30 05:39:26');";

        DB::insert($companies);
        User::insert($userTable);
        DB::insert($roles);
        DB::insert($usergroups);
        DB::insert($usergroupRole);
        DB::insert($module_submodule_permission);
        DB::insert($role_menu_submenu_permission);
        DB::insert($userUserGroup);

}




}
