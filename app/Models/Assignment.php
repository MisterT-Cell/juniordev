<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'type', 'region', 'requirements', 'status'];

    public function company() { return $this->belongsTo(User::class, 'user_id'); }
    public function applications() { return $this->hasMany(Application::class); }
}
