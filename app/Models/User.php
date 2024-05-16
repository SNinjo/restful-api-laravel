<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'name', 'age', 'created_at', 'updated_at'];
}
