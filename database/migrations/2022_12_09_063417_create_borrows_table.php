<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->string('kode_buku');
            $table->string('nispeminjam');
            $table->date('tanggalpinjam');
            $table->date('tanggalwajibkembali');
            $table->date('tanggalkembali')->nullable()->default(null);
            $table->integer('telat')->default(0);
            $table->timestamps();

            $table->foreign('kode_buku')
                ->references('kode')
                ->on('books')
                ->onUpdate('cascade')->onDelete('cascade');
            
            $table->foreign('nispeminjam')
                ->references('nis')
                ->on('members')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrows');
    }
};
