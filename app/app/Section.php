<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property string description
 * @property string logo
 */
class Section extends Model
{
    protected $fillable = ['name', 'description', 'logo'];


    /**
     * Получаем всех пользователей отдела
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'section_users');
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function getLogoUrlAttribute()
    {
        return asset('storage/logo/'.  $this->getLogo());
    }
}
