<?php

use Illuminate\Database\Seeder;

class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_menus')->truncate();

        DB::table('admin_menus')->insert([
            [
                // id => 1
                'language_id' => 3,
                'name' => null,
                'icon' => 'flaticon-line-graph',
                'root' => 1,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 3,
                'title' => 'Dashboard',
                'page' => '/',
                'order' => 1,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.DASHBOARD',
                'badgeType' => 'm-badge--danger',
                'badgeValue' => '2',
                'disabled' => 0
            ],
            [
                // id => 2
                'language_id' => 3,
                'name' => null,
                'icon' => 'flaticon-interface-1',
                'root' => 1,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 3,
                'title' => 'Settings',
                'page' => '/profile',
                'order' => 2,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.PROFILE',
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 0
            ],
            [
                // id => 3
                'language_id' => 3,
                'name' => null,
                'icon' => 'flaticon-layers',
                'root' => 1,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 3,
                'title' => 'Customer',
                'page' => '/customer-lk',
                'order' => 3,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.CUSTOMER_LK.TITLE',
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 0
            ],
            [
                // id => 4
                'language_id' => 3,
                'name' => null,
                'icon' => '',
                'root' => 0,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 3,
                'title' => 'Projects',
                'page' => '/customer-lk/projects',
                'order' => 0,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.CUSTOMER_LK.PROJECTS.TITLE',
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 0
            ],
            [
                // id => 5
                'language_id' => 3,
                'name' => null,
                'icon' => '',
                'root' => 0,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 3,
                'title' => 'My projects',
                'page' => '/customer-lk/projects/list',
                'order' => 0,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.CUSTOMER_LK.PROJECTS.LIST',
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 0
            ],
            [
                // id => 6
                'language_id' => 3,
                'name' => null,
                'icon' => '',
                'root' => 0,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 3,
                'title' => 'Create project',
                'page' => '/customer-lk/projects/new',
                'order' => 0,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.CUSTOMER_LK.PROJECTS.NEW',
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 0
            ],
            [
                // id => 7
                'language_id' => 3,
                'name' => null,
                'icon' => 'flaticon-suitcase',
                'root' => 1,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 3,
                'title' => 'Finances',
                'page' => '/finances',
                'order' => 4,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.FINANCES.TITLE',
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 0
            ],
            [
                // id => 8
                'language_id' => 3,
                'name' => null,
                'icon' => '',
                'root' => 0,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 3,
                'title' => 'Balance history',
                'page' => '/finances/balance',
                'order' => 0,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.FINANCES.BALANCE',
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 0
            ],
            [
                // id => 9
                'language_id' => 3,
                'name' => null,
                'icon' => '',
                'root' => 0,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 3,
                'title' => 'Recharge',
                'page' => '/finances/recharge',
                'order' => 0,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.FINANCES.RECHARGE',
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 0
            ],
            [
                // id => 10
                'language_id' => 3,
                'name' => null,
                'icon' => '',
                'root' => 0,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 3,
                'title' => 'Withdrawal funds',
                'page' => '/finances/withdrawal',
                'order' => 0,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.FINANCES.WITHDRAWAL',
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 0
            ],
            [
                // id => 11
                'language_id' => 3,
                'name' => null,
                'icon' => 'flaticon-envelope',
                'root' => 1,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 3,
                'title' => 'Messages',
                'page' => '/messages',
                'order' => 5,
                'desc' => null,
                'bullet' => null,
                'translate' => null,
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 1
            ],
            [
                // id => 12
                'language_id' => 3,
                'name' => null,
                'icon' => 'flaticon-line-graph',
                'root' => 1,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 2,
                'title' => 'Dashboard',
                'page' => '/',
                'order' => 1,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.DASHBOARD',
                'badgeType' => 'm-badge--danger',
                'badgeValue' => '2',
                'disabled' => 0
            ],
            [
                // id => 13
                'language_id' => 3,
                'name' => null,
                'icon' => 'flaticon-interface-1',
                'root' => 1,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 2,
                'title' => 'Settings',
                'page' => '/profile',
                'order' => 2,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.PROFILE',
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 0
            ],
            [
                // id => 14
                'language_id' => 3,
                'name' => null,
                'icon' => 'flaticon-layers',
                'root' => 1,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 2,
                'title' => 'Author',
                'page' => '/author-lk',
                'order' => 3,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.AUTHOR_LK.TITLE',
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 0
            ],
            [
                // id => 15
                'language_id' => 3,
                'name' => null,
                'icon' => '',
                'root' => 0,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 2,
                'title' => 'Projects',
                'page' => '/author-lk/projects',
                'order' => 0,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.AUTHOR_LK.PROJECTS.TITLE',
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 0
            ],
            [
                // id => 16
                'language_id' => 3,
                'name' => null,
                'icon' => '',
                'root' => 0,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 2,
                'title' => 'All',
                'page' => '/author-lk/projects/list',
                'order' => 0,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.AUTHOR_LK.PROJECTS.LIST',
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 0
            ],
            [
                // id => 17
                'language_id' => 3,
                'name' => null,
                'icon' => '',
                'root' => 0,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 2,
                'title' => 'Personal',
                'page' => '/author-lk/projects/personal',
                'order' => 0,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.AUTHOR_LK.PROJECTS.PERSONAL',
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 0
            ],
            [
                // id => 18
                'language_id' => 3,
                'name' => null,
                'icon' => '',
                'root' => 0,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 2,
                'title' => 'Favorites',
                'page' => '/author-lk/projects/favorites',
                'order' => 0,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.AUTHOR_LK.PROJECTS.FAVORITES',
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 0
            ],
            [
                // id => 19
                'language_id' => 3,
                'name' => null,
                'icon' => '',
                'root' => 0,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 2,
                'title' => 'My works',
                'page' => '/author-lk/works',
                'order' => 0,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.AUTHOR_LK.WORKS',
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 0
            ],
            [
                // id => 20
                'language_id' => 3,
                'name' => null,
                'icon' => 'flaticon-suitcase',
                'root' => 1,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 2,
                'title' => 'Finances',
                'page' => '/finances',
                'order' => 4,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.FINANCES.TITLE',
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 0
            ],
            [
                // id => 21
                'language_id' => 3,
                'name' => null,
                'icon' => '',
                'root' => 0,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 2,
                'title' => 'Balance history',
                'page' => '/finances/balance',
                'order' => 0,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.FINANCES.BALANCE',
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 0
            ],
            [
                // id => 22
                'language_id' => 3,
                'name' => null,
                'icon' => '',
                'root' => 0,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 2,
                'title' => 'Recharge',
                'page' => '/finances/recharge',
                'order' => 0,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.FINANCES.RECHARGE',
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 0
            ],
            [
                // id => 23
                'language_id' => 3,
                'name' => null,
                'icon' => '',
                'root' => 0,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 2,
                'title' => 'Withdrawal funds',
                'page' => '/finances/withdrawal',
                'order' => 0,
                'desc' => null,
                'bullet' => null,
                'translate' => 'MENU.FINANCES.WITHDRAWAL',
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 0
            ],
            [
                // id => 24
                'language_id' => 3,
                'name' => null,
                'icon' => 'flaticon-envelope',
                'root' => 1,
                'url' => null,
                'controller' => null,
                'function' => null,
                'args' => null,
                'roles_id' => 2,
                'title' => 'Messages',
                'page' => '/messages',
                'order' => 5,
                'desc' => null,
                'bullet' => null,
                'translate' => null,
                'badgeType' => null,
                'badgeValue' => null,
                'disabled' => 1
            ]
        ]);

        DB::table('admin_menus_has_admin_menus')->truncate();

        DB::table('admin_menus_has_admin_menus')->insert([
            [
                'admin_menu_id' => 3,
                'admin_child_id' => 4,
                'order' => '1'
            ],
            [
                'admin_menu_id' => 4,
                'admin_child_id' => 5,
                'order' => '1'
            ],
            [
                'admin_menu_id' => 4,
                'admin_child_id' => 6,
                'order' => '2'
            ],
            [
                'admin_menu_id' => 7,
                'admin_child_id' => 8,
                'order' => '1'
            ],
            [
                'admin_menu_id' => 7,
                'admin_child_id' => 9,
                'order' => '2'
            ],
            [
                'admin_menu_id' => 7,
                'admin_child_id' => 10,
                'order' => '3'
            ],
            [
                'admin_menu_id' => 14,
                'admin_child_id' => 15,
                'order' => '1'
            ],
            [
                'admin_menu_id' => 14,
                'admin_child_id' => 19,
                'order' => '2'
            ],
            [
                'admin_menu_id' => 15,
                'admin_child_id' => 16,
                'order' => '1'
            ],
            [
                'admin_menu_id' => 15,
                'admin_child_id' => 17,
                'order' => '2'
            ],
            [
                'admin_menu_id' => 15,
                'admin_child_id' => 18,
                'order' => '3'
            ],
            [
                'admin_menu_id' => 20,
                'admin_child_id' => 21,
                'order' => '1'
            ],
            [
                'admin_menu_id' => 20,
                'admin_child_id' => 22,
                'order' => '2'
            ],
            [
                'admin_menu_id' => 20,
                'admin_child_id' => 23,
                'order' => '3'
            ]
        ]);
    }
}
