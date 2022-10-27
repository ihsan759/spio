<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $protectFields = false;
    protected $primaryKey = 'nip';
    protected $useSoftDeletes = true;
}
