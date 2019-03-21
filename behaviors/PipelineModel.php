<?php namespace Prismify\Pipeline\Behaviors;

use System\Classes\ModelBehavior;
use Prismify\Pipeline\Models\Stage;
use Prismify\Pipeline\Models\Pipeline;

/**
 * Pipeline model extension
 *
 * Adds Pipeline and Stage relations to a model
 *
 * Usage:
 *
 * In the model class definition:
 *
 *   public $implement = ['@Prismify.Pipeline.Behaviors.PipelineModel'];
 *
 */
class PipelineModel extends ModelBehavior
{
    /**
     * Constructor
     */
    public function __construct($model)
    {
        parent::__construct($model);

        $guarded = $model->getGuarded();

        if (count($guarded) === 1 && $guarded[0] === '*') {
            $model->addFillable([
                'pipeline',
                'pipeline_id',
                'stage',
                'stage_id',
            ]);
        }

        $model->belongsTo['pipeline'] = ['Prismify\Pipeline\Models\Pipeline'];
        $model->belongsTo['stage']   = ['Prismify\Pipeline\Models\Stage'];
    }

    public function getPipelineOptions()
    {
        return Pipeline::getNameList();
    }

    public function getStageOptions()
    {
        return Stage::getNameList($this->model->pipeline_id);
    }

    /**
     * Ensure an integer value is set, otherwise nullable.
     */
    public function setPipelineIdAttribute($value)
    {
        $this->model->attributes['pipeline_id'] = $value ?: null;
    }

    /**
     * Ensure an integer value is set, otherwise nullable.
     */
    public function setStageIdAttribute($value)
    {
        $this->model->attributes['stage_id'] = $value ?: null;
    }
}
