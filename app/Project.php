<?php

namespace App;

use App\Mail\ProjectCreated;
use PhpParser\Node\Stmt\Static_;
use App\Events\ProjectCreated as ProjectExtendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    protected $fillable = ['title','description','owner_id','image','status'];

    protected $dispachesEvents = [
        'created' => ProjectExtendMail::class
    ];


    public function owner()
    {
        return $this->belongsTo(User::class);
    }


    public function Tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($description)
    {
        $attributes = request()->validate(['description' => 'required']);

        $this->Tasks()->create($attributes);

        /* return Task::create([
            'project_id' => $this->id,
            'description' => $description
        ]); */
    }


    public function statusname()
    {
        return $this->hasOne(ProjectStatus::class, 'id','status');
    }

}
