<?php

namespace Encore\Admin\Translation;

use Illuminate\Database\Eloquent\Model;

class LocaleModel extends Model
{
    protected $fillable = ['code', 'name'];

    /**
     * Settings constructor.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        parent::__construct($attributes);

        $this->setConnection(config('admin.database.connection') ?: config('database.default'));

        $this->setTable(config('admin.extensions.translation.locales_table', 'laravel_locales'));
    }

    public static function geAllLocales()
    {
        return  static::select(['code', 'name'])
            ->get()
            ->mapWithKeys(function ($row) {
                return [$row->code => $row->name];
            })
            ->toArray();
    }

    public static function getAllLocaleCodes()
    {
        return array_flatten(static::select('code')
            ->get()
            ->toArray());
    }
}
