<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\BelongsTo};

final class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'assigned_by_id', 'assigned_to_id'];

    public function getUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function getAdmin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'assigned_by_id');
    }
}
