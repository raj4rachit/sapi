<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasUuids, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'avatar',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
           // 'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*public function createVerificationToken(int $hours = 24): string
    {
        // Generate a unique verification token
        $token = Str::random(64); // Adjust the length as needed

        // Set token expiry time (e.g., 24 hours from now)
        $expiry = Carbon::now()->addHours($hours);

        // Store the token and expiry timestamp in the database
        $this->verification_token = $token;
        $this->verification_token_expiry = $expiry;
        $this->save();

        return GlobalHelper::encrypt($token);
    }*/
}
