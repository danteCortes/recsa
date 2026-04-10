<?php

namespace App\Src\Infrastructure\Auth\Persistence\Models;

use MongoDB\Laravel\Eloquent\Model;
use Laravel\Sanctum\Contracts\HasAbilities;
use Illuminate\Support\Carbon;

class PersonalAccessToken extends Model implements HasAbilities
{
    protected $connection = 'mongodb';

    protected $collection = 'personal_access_tokens';

    protected $fillable = [
        'name',
        'token',
        'abilities',
        'expires_at',
        'tokenable_id',
        'tokenable_type',
    ];

    protected $hidden = [
        'token',
    ];

    protected $casts = [
        'abilities' => 'json',
        'last_used_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public static function findToken(string $token): ?self
    {
        if (!str_contains($token, '|')) {
            return static::where('token', hash('sha256', $token))->first();
        }

        [$id, $plainToken] = explode('|', $token, 2);

        $instance = static::find($id);

        if ($instance && hash_equals($instance->token, hash('sha256', $plainToken))) {
            return $instance;
        }

        return null;
    }

    // Relación polimórfica hacia el usuario
    public function tokenable()
    {
        return $this->morphTo('tokenable');
    }

    // --- Métodos requeridos por HasAbilities ---

    public function can($ability): bool
    {
        return in_array('*', $this->abilities ?? [])
            || in_array($ability, $this->abilities ?? []);
    }

    public function cant($ability): bool
    {
        return ! $this->can($ability);
    }
}