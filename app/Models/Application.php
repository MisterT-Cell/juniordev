<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['job_id', 'user_id', 'motivation', 'status'];

    public function job() { return $this->belongsTo(Job::class); }
    public function student() { return $this->belongsTo(User::class, 'user_id'); }
}
