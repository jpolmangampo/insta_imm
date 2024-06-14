<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function run(): void
    {
        $users = [
            [
                'name'      => 'Charles Xavier',
                'email'     => 'prof@x.com',
                'password'  => Hash::make('test12345')
            ],
            [
                'name'      => 'Steve Rogers',
                'email'     => 'cap@a.com',
                'password'  => Hash::make('test12345')
            ],
            [
                'name'      => 'Bruce Banner',
                'email'     => 'hulk@a.com',
                'password'  => Hash::make('test12345')
            ],
            [
                'name'      => 'Tony Stark',
                'email'     => 'Fe@man.com',
                'password'  => Hash::make('test12345')
            ],
            [
                'name'      => 'Clint Burton',
                'email'     => 'hk@a.com',
                'password'  => Hash::make('test12345')
            ],
        ];

        $this->user->insert($users);
    }
}
