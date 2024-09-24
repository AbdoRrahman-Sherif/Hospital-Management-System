<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Doctors extends Authenticatable
{
    use HasFactory, SoftDeletes;
    protected $table = 'doctors';
    protected $fillable = [
        'name',
        'email',
        'password',
        'fees',
        'specialization',
        'admin_id',
        'createdBy',
        'updatedBy',
        'deletedBy'
    ];
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';
    

}
