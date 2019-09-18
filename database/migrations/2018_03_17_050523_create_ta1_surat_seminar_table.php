<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateTa1SuratSeminarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('ta1_surat_seminar', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pembimbing_id');
            $table->unsignedInteger('pembimbing_opsional_id')->nullable();
            $table->unsignedInteger('penguji1_id')->nullable();
            $table->unsignedInteger('penguji2_id')->nullable();
            $table->date('tanggal_terbit')->nullable();
            $table->string('nomor_kop_surat')->nullable();
            $table->unsignedInteger('seminar_id');
            $table->foreign('pembimbing_id')->references('user_id')->on('dosen')->onDelete('cascade');
            $table->foreign('pembimbing_opsional_id')->references('user_id')->on('dosen')->onDelete('cascade');
            $table->foreign('penguji1_id')->references('user_id')->on('dosen')->onDelete('cascade');
            $table->foreign('penguji2_id')->references('user_id')->on('dosen')->onDelete('cascade');
            $table->foreign('seminar_id')->references('id')->on('ta1_seminar')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('ta1_surat_seminar');
        Schema::enableForeignKeyConstraints();
    }
}