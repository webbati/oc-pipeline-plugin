<?php namespace Prismify\Pipeline\Models;

use Form;
use Model;
use October\Rain\Database\Traits\Validation;

/**
 * Pipeline Model
 */
class Pipeline extends Model
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'prismify_pipeline_pipelines';

    /**
     * @var array Validation fields
     */
    public $rules = [
        'name' => 'required',
    ];

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['name'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'stages' => Stage::class,
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function getStageCountAttribute()
    {
        return $this->stages()->count();
    }

    /**
     * @var bool Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * @var array Cache for nameList() method
     */
    protected static $nameList = null;

    public static function getNameList()
    {
        if (self::$nameList) {
            return self::$nameList;
        }

        return self::$nameList = self::isEnabled()->lists('name', 'id');
    }

    public static function formSelect($name, $selectedValue = null, $options = [])
    {
        return Form::select($name, self::getNameList(), $selectedValue, $options);
    }

    public function scopeIsEnabled($query)
    {
        return $query->where('is_enabled', true);
    }
}
