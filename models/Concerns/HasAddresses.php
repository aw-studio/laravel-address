<?php

namespace App\Models\Concerns;

use App\Models\Address;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasAddresses
{
    /**
     * Get all attached addresses to the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Gets the latest attached address to the model that is primary.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function primary_address(): MorphOne
    {
        return $this
            ->morphOne(Address::class, 'addressable')
            ->ofMany(['id' => 'max'], function ($subQuery) {
                $subQuery->where('is_primary', true);
            });
    }

    /**
     * Gets the latest attached address to the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function latest_address(): MorphOne
    {
        return $this
            ->morphOne(Address::class, 'addressable')
            ->latestOfMany();
    }

    /**
     * Boot the HasAddresses trait for the model.
     *
     * @return void
     */
    public static function bootHasAddresses()
    {
        static::deleted(function (self $model) {
            $model->addresses()->delete();
        });
    }
}
