<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class Student extends Model
{
    use HasFactory,HasApiTokens;

    protected $fillable =[
        "name",
        "course",
        "age",
        "email",
        "password"
    ];

    // public function user()
    // {
    //     return this->belongsTo(User::class);
    // }
}
