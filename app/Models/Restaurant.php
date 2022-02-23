<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'display_name'
    ];

    /**
     * Scopes
     */
    public function scopeAssignable(Builder $query, int $employee_id): Builder
    {
        return $query->where(function ($q) use ($employee_id) {
            return $q->has('employees', '<', config('enums.limit_employee'))
                ->orDoesntHave('employees')
                ->orWhereHas('employees', function ($qq) use ($employee_id) {
                    $qq->whereId($employee_id);
                });
        });
    }

    /**
     * Relations
     */
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'restaurant_employee');
    }
}
