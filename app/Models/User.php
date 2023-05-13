<?php

namespace App\Models;

use App\Models\Roles\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

/**
 * @property string $name,
 * @property string $email,
 * @property string $password,
 *
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'avatar',
        'password', 'active',
    ];

    protected $casts = ['active' => 'boolean'];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function card(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Card::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // возращает текущую Auth::user() сессию юзера
    public function getUser()
    {
        return Auth::user();
    }

    // возращает текущую корзину
    public function getCard()
    {
        $user = $this->getUser();

        return $user->card()->first();
    }

    // возращает общую сумму продуктов корзины
    public function getProductSum()
    {
        return $this->getCard()->products()->sum('price');
    }

    // возращает количество продуктов корзины
    public function getProductCount()
    {
        return $this->getCard()->products()->count();
    }

    // создаем корзину юзеру при создании юзера
    // добавляем ему роль 'user'
    protected static function boot()
    {
        parent::boot();
        self::created(function ($user) {
            $card = new Card;
            $card->user_id = $user->id;
            $card->save();
        });

        self::created(function ($user) {
            $role = Role::query()->where('name', 'user')->first();
            if ($role) {
                $user->roles()->created_at = now();
                $user->roles()->updated_at = now();
                $user->roles()->attach($role);
            }
        });
    }

    // проверка на роль у юзера
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            return $this->roles()->pluck('name')->intersect($roles)->count() > 0;
        }

        return $this->roles()->pluck('name')->contains($roles);
    }


}
