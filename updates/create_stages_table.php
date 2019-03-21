<?php namespace Prismify\Pipeline\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateStagesTable extends Migration
{
    public function up()
    {
        Schema::create('prismify_pipeline_stages', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('pipeline_id')->unsigned()->index();
            $table->string('name')->index();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prismify_pipeline_stages');
    }
}
