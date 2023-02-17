<?php

use App\Models\Owner;
use App\Models\VehicleType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();

            $table->string('fullname');
            $table->string('phone');

            $table->foreignIdFor(VehicleType::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignIdFor(Owner::class)
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->boolean('service')->default(0);
            $table->boolean('status')->default(1);
            $table->boolean('dnu')->default(0);

            $table->string('capacity')->nullable();
            $table->string('dimension')->nullable();

            $table->string('citizenship')->nullable();

            $table->integer('zipcode')->nullable();
            $table->string('location')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->integer('future_zipcode')->nullable();
            $table->string('future_location')->nullable();
            $table->string('future_latitude')->nullable();
            $table->string('future_longitude')->nullable();
            $table->dateTime('future_datetime')->nullable();

            $table->mediumText('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drivers');
    }
};
