<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        "dni",
        "region_id",
        "commune_id",
        "email",
        "name",
        "last_name",
        "address",
        "status",
    ];
}
