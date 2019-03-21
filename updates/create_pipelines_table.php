<?php namespace Prismify\Pipeline\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePipelinesTable extends Migration
{
    public function up()
    {
        Schema::create('prismify_pipeline_pipelines', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->index();
            $table->string('code');
            $table->boolean('is_enabled')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('prismify_pipeline_pipelines');
    }
}
