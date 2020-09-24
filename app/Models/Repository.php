<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    protected $fillable = [
        'url', 'name', 'description', 'owner_login', 'stargazers_count'
    ];
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'users_repositories');
    }
}
