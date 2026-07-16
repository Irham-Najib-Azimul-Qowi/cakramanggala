<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'key',
        'value'
    ];

    /**
     * Get a setting value by its key with fallback default.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function getValue($key, $default = null)
    {
        $setting = self::find($key);
        $val = $setting ? $setting->value : $default;

        if ($key === 'periode_pengurus') {
            if ($val === 'auto' || empty($val)) {
                $now = now();
                $month = $now->month;
                $year = $now->year;
                if ($month >= 9) {
                    return 'PERIODE ' . $year . ' — ' . ($year + 1);
                } else {
                    return 'PERIODE ' . ($year - 1) . ' — ' . $year;
                }
            }
        }

        return $val;
    }
}
