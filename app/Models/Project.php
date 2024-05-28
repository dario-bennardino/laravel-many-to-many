<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // essendo una one to many il project appartiene a una technology quindi anche il model
    // in una one to many (dalla parte del belongsTo) il nome della funzione deve essere il nome del model (al singolare)
    // questa funzione verrà letta come una proprietà del model (es. $project->technology)
    public function technology()
    {
        return $this->belongsTo(Technology::class);
    }

    protected $fillable = ['technology_id', 'title', 'name', 'slug', 'description', 'image', 'creation_date'];
}
