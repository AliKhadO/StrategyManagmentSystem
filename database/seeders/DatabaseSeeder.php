<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Create Roles
        $admin = Role::create(['name' => 'admin']);
        $manager = Role::create(['name' => 'manager']);
        $team_leader = Role::create(['name' => 'team_leader']);
        $specialist = Role::create(['name' => 'specialist']);

        // Create Permissions
        Permission::create(['name' => 'edit plans'])->assignRole([$admin, $manager]);
        Permission::create(['name' => 'add plans'])->assignRole([$admin, $manager]);
        Permission::create(['name' => 'show plans'])->assignRole([$admin, $manager, $team_leader, $specialist]);
        Permission::create(['name' => 'delete plans'])->assignRole([$admin, $manager]);
        //create permissions for goals
        Permission::create(['name' => 'edit goals'])->assignRole([$admin, $manager]);
        Permission::create(['name' => 'add goals'])->assignRole([$admin, $manager]);
        Permission::create(['name' => 'show goals'])->assignRole([$admin, $manager, $team_leader, $specialist]);
        Permission::create(['name' => 'delete goals'])->assignRole([$admin, $manager]);

          //create permissions for goals
          Permission::create(['name' => 'edit departments'])->assignRole([$admin, $manager]);
          Permission::create(['name' => 'add departments'])->assignRole([$admin, $manager]);
          Permission::create(['name' => 'show departments'])->assignRole([$admin, $manager]);
          Permission::create(['name' => 'delete departments'])->assignRole([$admin, $manager]);

        //create permissions for tasks
        Permission::create(['name' => 'edit tasks'])->assignRole([$admin, $manager, $team_leader]);
        Permission::create(['name' => 'add tasks'])->assignRole([$admin, $manager, $team_leader]);
        Permission::create(['name' => 'show tasks'])->assignRole([$admin, $manager, $team_leader, $specialist]);
        Permission::create(['name' => 'delete tasks'])->assignRole([$admin, $manager, $team_leader]);
        Permission::create(['name' => 'close tasks'])->assignRole([$admin, $manager, $team_leader, $specialist]);
        // create permissions for reports
        Permission::create(['name' => 'show reports'])->assignRole([$admin, $manager]);


        \App\Models\Department::factory(1)->create([
            'name' => 'Default',
            'description' => 'Default Department',
            'location' => fake()->streetAddress()
        ]);

        \App\Models\Department::factory(1)->create([
            'name' => 'IT',
            'description' => 'Infomration Technogy',
            'location' => fake()->streetAddress()
        ]);

        \App\Models\Department::factory(1)->create([
            'name' => 'Finance',
            'description' => 'Finance Department',
            'location' => fake()->streetAddress()
        ]);




        \App\Models\User::factory(1)->create([
            'name' => 'Alaa', //fake()->name(),
            'last_name'=> 'Nabeh',
            'email' => 'alaa@example.com', //fake()->unique()->safeEmail(),
            'phone_number' => fake()->phoneNumber(),
            'department_id' => Department::inRandomOrder()->first()->id,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' // password
        ])->each(function ($user) {
            $user->assignRole('admin');
        });



        \App\Models\User::factory(1)->create([
            'name' => 'Jihad', //fake()->name(),
            'last_name'=> 'S',
            'email' => 'jihad@example.com', //fake()->unique()->safeEmail(),
            'phone_number' => fake()->phoneNumber(),
            'department_id' => Department::inRandomOrder()->first()->id,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' // password
        ])->each(function ($user) {
            $user->assignRole('manager');
        });


        \App\Models\User::factory(1)->create([
            'name' => 'Ali', //fake()->name(),
            'last_name'=> 'K',
            'email' => 'ali@example.com', //fake()->unique()->safeEmail(),
            'phone_number' => fake()->phoneNumber(),
            'department_id' => Department::inRandomOrder()->first()->id,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' // password
        ])->each(function ($user) {
            $user->assignRole('team_leader');
        });

        \App\Models\User::factory(1)->create([
            'name' => 'Go', //fake()->name(),
            'last_name'=> 'Strategy',
            'email' => 'GoStrategyMail@gmail.com', //fake()->unique()->safeEmail(),
            'phone_number' => fake()->phoneNumber(),
            'department_id' => Department::inRandomOrder()->first()->id,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' // GoStr@tegy123
        ])->each(function ($user) {
            $user->assignRole('admin');
        });



        // \App\Models\Goal::factory(10)->create();
        // \App\Models\Plan::factory(10)->create();
        // \App\Models\Task::factory(10)->create()->each(function ($task) {
        //     // create Criteria ,Risks and Updates
        //     \App\Models\Updates::factory(10)->create(['task_id' => $task->id]);
        //     \App\Models\Criteria::factory(10)->create(['task_id' => $task->id]);
        //     \App\Models\Risk::factory(10)->create(['task_id' => $task->id]);
        // });
    }
}
