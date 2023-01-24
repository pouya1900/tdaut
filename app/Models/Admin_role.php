<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Admin_role extends Model
{
    protected $fillable = [
        'title',
        'name',
    ];
    use HasFactory;

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Admin_permission::class, 'admin_permission_role', 'role_id', 'permission_id');
    }

    /**
     * @return HasMany
     */
    public function administrator(): HasMany
    {
        return $this->hasMany(Administrator::class, 'role_id');
    }

}
