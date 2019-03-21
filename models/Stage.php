<?php namespace Prismify\Pipeline\Models;

use Form;
use Model;
use October\Rain\Database\Traits\Validation;

/**
 * Stage Model
 */
class Stage extends Model
{
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'prismify_pipeline_stages';

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
    public $hasMany = [];
    public $belongsTo = [
        'pipeline' => Pipeline::class
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    /**
     * @var bool Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * @var array Cache for nameList() method
     */
    protected static $nameList = [];

    public static function getNameList($pipelineId)
    {
        if (isset(self::$nameList[$pipelineId])) {
            return self::$nameList[$pipelineId];
        }

        return self::$nameList[$pipelineId] = self::wherePipelineId($pipelineId)->lists('name', 'id');
    }

    public static function formSelect($name, $pipelineId = null, $selectedValue = null, $options = [])
    {
        return Form::select($name, self::getNameList($pipelineId), $selectedValue, $options);
    }
}
