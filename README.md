## Overview
Track deals, projects or support at each stage and what’s scheduled to close.

## Installation
To install from the Marketplace, click on the "Add to Project" button and then select the project you wish to add it to before updating the project to pull in the plugin.

To install from the backend, go to Settings -> Updates & Plugins -> Install Plugins and then search for Prismify.Pipeline.

### Add Pipeline and Stage to any model

This plugin provides an easy way to add pipeline fields, pipeline and stage, to any model. Simply add these columns to the database table:

    $table->integer('pipeline_id')->unsigned()->nullable()->index();
    $table->integer('stage_id')->unsigned()->nullable()->index();

Then implement the **Prismify.Pipeline.Behaviors.PipelineModel** behavior in the model class:

    public $implement = ['Prismify.Pipeline.Behaviors.PipelineModel'];

This will automatically create two "belongs to" relationships:

1. **pipeline** - relation for Prismify\Pipeline\Models\Prismify
2. **stage** - relation for Prismify\Pipeline\Models\Stage

### Back-end usage

#### Forms

You are free to add the following form field definitions:

    pipeline:
        label: Pipeline
        placeholder: -- select pipeline --
        type: dropdown

    stage:
        label: Stage
        placeholder: -- select stage --
        type: dropdown
        dependsOn: pipeline

#### Lists

For the list column definitions, you can use the following snippet:

     pipeline:
         label: Pipeline
         searchable: true
         relation: pipeline
         select: name
         sortable: false

     stage:
         label: Stage
         searchable: true
         relation: stage
         select: name
         sortable: false
         
## Open to your Ideas!
Let us know if you have any questions, ideas or suggestions! Just drop a line at [support@prismify.org](mailto:support@prismify.org).

**Developed by [Algoriq](https://github.com/algoriq).**
