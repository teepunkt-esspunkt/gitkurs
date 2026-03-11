<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
   use HasFactory;

   protected function casts(): array
    {
        return [
            'due_date' => 'date',   // Notwendig für $tasks->due_date->format('d.m.Y'); // da ansonsten ein String
        ];
    }

    // Relation
    // tasks->user
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
