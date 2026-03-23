<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'is_blocked'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_blocked' => 'boolean',
        ];
    }

    public function isStudent(): bool { return $this->role === 'student'; }
    public function isCompany(): bool { return $this->role === 'company'; }
    public function isAdmin(): bool { return $this->role === 'admin'; }

    public function studentProfile() { return $this->hasOne(StudentProfile::class); }
    public function companyProfile() { return $this->hasOne(CompanyProfile::class); }
    public function assignments() { return $this->hasMany(Assignment::class); }
    public function applications() { return $this->hasMany(Application::class); }
    public function sentMessages() { return $this->hasMany(Message::class, 'sender_id'); }
    public function receivedMessages() { return $this->hasMany(Message::class, 'receiver_id'); }
}
