<?php namespace Prismify\Pipeline\Controllers;

use Lang;
use Flash;
use Backend;
use Redirect;
use Exception;
use BackendMenu;
use Backend\Classes\Controller;
use System\Classes\SettingsManager;
use Backend\Behaviors\FormController;
use Backend\Behaviors\ListController;
use Backend\Behaviors\RelationController;
use Prismify\Pipeline\Models\Pipeline;

/**
 * Pipelines Back-end Controller
 */
class Pipelines extends Controller
{
    public $implement = [
        FormController::class,
        ListController::class,
        RelationController::class
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = [
        'prismify.pipeline.access_pipeline_settings'
    ];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('Prismify.Pipelines', 'pipelines');
    }

    /**
     * {@inheritDoc}
     */
    public function listInjectRowClass($record, $definition = null)
    {
        if (!$record->is_enabled) {
            return 'safe disabled';
        }
    }

    public function onLoadDisableForm()
    {
        try {
            $this->vars['checked'] = post('checked');
        }
        catch (Exception $ex) {
            $this->handleError($ex);
        }

        return $this->makePartial('disable_form');
    }

    public function onDisablePipelines()
    {
        $enable = post('enable', false);

        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $objectId) {
                if (!$object = Pipeline::find($objectId)) {
                    continue;
                }

                $object->is_enabled = $enable;
                $object->save();
            }

        }

        if ($enable) {
            Flash::success(Lang::get('Successfully enabled those pipelines.'));
        }
        else {
            Flash::success(Lang::get('Successfully disabled those pipelines.'));
        }

        return Backend::redirect('prismify/pipeline/pipelines');
    }
}
