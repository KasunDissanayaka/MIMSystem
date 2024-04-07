<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerRecord extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'address', 'contact_information', 'email', 'age', 'nic_number', 'gender'
    ];
}
