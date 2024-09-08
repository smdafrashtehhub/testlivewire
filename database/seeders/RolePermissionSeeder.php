<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //-------------------------- permission -------------------------
        $comment=Permission::create(['name'=>'comment']);
        $image=Permission::create(['name'=>'image']);
        $post=Permission::create(['name'=>'post']);

        //-------------------------- admin ------------------------------
        $admin=Role::create(['name'=>'admin']);
        $admin->givePermissionTo([
           $comment,
           $image,
           $post,
        ]);
        $adminuser=User::create([
            'name'=>'ahmad',
            'email'=>'ahmad@gmail.com',
            'role'=>'admin',
            'password'=>Hash::make(123456),
        ]);
        $adminuser->assignRole($admin);
        $adminuser->givePermissionTo([
            $comment,
            $image,
            $post,
        ]);

        //-------------------------- user ------------------------------
        $user=Role::create(['name'=>'user']);
        $user->givePermissionTo([
            $comment,
            $post
        ]);
        $user1=User::create([
           'name'=>'mohamad',
           'email'=>'mohamad@gmail.com',
            'role'=>'user',
            'password'=>Hash::make(1234567),
        ]);
        $user1->assignRole($user);
        $user->givePermissionTo([
            $comment
        ]);
    }
}
