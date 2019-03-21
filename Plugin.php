<?php namespace Prismify\Pipeline;

use Backend;
use System\Classes\PluginBase;

/**
 * Pipeline Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Pipeline',
            'description' => 'Track deals, projects or support at each stage and what’s scheduled to close.',
            'author'      => 'Prismify',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'prismify.pipeline.access_pipeline_settings' => [
                'tab' => 'Pipeline',
                'label' => 'Manage pipeline settings'
            ],
        ];
    }

    /**
     * Registers back-end settings for this plugin.
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'pipelines' => [
                'label'       => 'Pipelines',
                'description' => 'Manage available pipeline settings.',
                'category'    => 'Pipelines',
                'icon'        => 'icon-random',
                'url'         => Backend::url('prismify/pipeline/pipelines'),
                'order'       => 600,
                'permissions' => ['prismify.pipelines.access_pipeline_settings'],
                'keywords'    => 'pipelines, stages',
            ]
        ];
    }
}
