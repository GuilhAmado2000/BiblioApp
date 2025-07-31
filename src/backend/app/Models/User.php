<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public static function FindOrCreate($data)
    {
        $user = self::where('username', $data['username'])->first();

        if (!$user) {
            $userData = $data;

            if (isset($userData['password'])) {
                $userData['password'] = Hash::make($userData['password']);
            }

            $user = self::create($userData);

            if (preg_match('/^admin\./i', $data['username'])){
                $user->profile = 'ADMINISTRATOR';
            } else {
                $user->profile = 'LEITOR';
            }

            $user->save();
        }

        return $user;
    }
}
