<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesUser extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'role_id', 'fak_prod_id'];

    /**
     * Get all of the user for the RolesUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get all of the role for the RolesUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function role(): HasMany
    {
        return $this->hasMany(Role::class);
    }
}
