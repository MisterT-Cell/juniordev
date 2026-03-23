<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'company_name', 'description', 'website', 'region', 'phone', 'logo'];

    public function user() { return $this->belongsTo(User::class); }
    public function assignments() { return $this->hasMany(Assignment::class, 'user_id', 'user_id'); }
}
