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

    public static function boot()
    {
        parent::boot();
        $locales = [];
        $locales_trans = [];
        $locales = array_flatten(static::select('code')->get()->toarray());
        $locales_trans = static::select(['code', 'name'])->get()->mapWithKeys(function($row){
            return [$row->code => $row->name];
        })->toarray();
        // dd($locales, $locales_trans);
        config([
            'admin.extensions.translation.locales' => $locales,
            'admin.extensions.translation.locales_trans' => $locales_trans,
        ]);
        // dd(Translation::config('locales'), Translation::config('locales_trans'));
    }
}
