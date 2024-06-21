<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaves extends Model
{
    use HasFactory;
    protected $fillable = [
        'description','start_date','end_date','user_id','apply_date','leave_type'
    ];
}
