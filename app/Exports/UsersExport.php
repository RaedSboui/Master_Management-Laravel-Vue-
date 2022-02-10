<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromQuery, WithHeadings
{
    use Exportable;
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function headings():array{
        return['Id', 'First Name', 'Last Name', 'E-mail', 'Username', 'Password', 'Is Locked', 'Created_at', 'Updated_at'];
    } 

    public function query()
    {
        return User::query()->whereKey($this->users)->with('roles');
    }
}