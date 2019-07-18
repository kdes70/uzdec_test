<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Jenssegers\Date\Date;

/**
 * @property mixed state
 * @property mixed created_at
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'state',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    const STATE_WAIT = 'wait'; // в ожидание
    const STATE_ACTIVE = 'active'; // астивен
    const STATE_BANNED = 'banned'; // забанен на время

    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';


    /**
     * Получаем отделы пользователя
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sections()
    {
        return $this->belongsToMany(Section::class, 'section_users');
    }

    /**
     * Спосок состояний
     *
     * @return array
     */
    public static function getStatesList()
    {
        return [
            self::STATE_WAIT => 'В ожидание',
            self::STATE_ACTIVE => 'Астивен',
            self::STATE_BANNED => 'Забанен',
        ];
    }

    public static function getRoleList()
    {
        return [
            self::ROLE_USER => 'Пользователь',
            self::ROLE_ADMIN => 'Администратор',
        ];
    }

    public function isWait(): bool
    {
        return $this->state === self::STATE_WAIT;
    }

    public function isActive(): bool
    {
        return $this->state === self::STATE_ACTIVE;
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isUser()
    {
        return $this->role === self::ROLE_USER;
    }

    public function getCreatedAtFormatAttribute()
    {
        Date::setLocale('ru');
        return Date::parse($this->created_at)->format('j F H:i:s');
    }
}
