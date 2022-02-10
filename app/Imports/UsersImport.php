<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $user = User::create([
            'firstName'=> $row['first_name'],
            'lastName'=> $row['last_name'],
            'email'=> $row['email'] ,
            'username'=> $row['username'],
            'password'=> Hash::make($row['password']),
            'isLocked'=> $row['is_locked'],
        ]);
        $user->roles()->attach($row['role']);
        return $user;
    }
}
