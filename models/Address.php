<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'addressable_id',
        'addressable_type',
        'first_name',
        'last_name',
        'organization',
        'country_code',
        'language_code',
        'street',
        'state',
        'city',
        'postal_code',
        'is_primary',
        'is_billing',
        'is_shipping',
    ];

    /**
     * Attribute casts.
     *
     * @var array
     */
    protected $casts = [
        'is_primary'  => 'boolean',
        'is_billing'  => 'boolean',
        'is_shipping' => 'boolean',
        'deleted_at'  => 'datetime',
    ];

    /**
     * Get the owner model of the address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function addressable(): MorphTo
    {
        return $this->morphTo('addressable', 'addressable_type', 'addressable_id', 'id');
    }

    /**
     * Get full name attribute.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return implode(' ', [$this->given_name, $this->family_name]);
    }
}
