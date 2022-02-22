<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'display_name'
    ];

    public function scopeAssignable($query) {
        $query->has('employees', '<=', config('enums.limit_employee'))->orDoesntHave('employees');
    }

    public function employees() {
        return $this->belongsToMany(Employee::class, 'restaurant_employee');
    }
}
