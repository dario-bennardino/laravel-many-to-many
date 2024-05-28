<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    // essendo una one to many la technology ha molti project
    // in una one to many (dalla parte del hasMany) il nome della funzione deve essere il nome del model (al plurale)
    // questa funzione verrà letta come una proprietà del model (es. $technology->projects)

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    protected $fillable = ['name'];
}
