<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->increments('mahasiswa_id')->unsigned();
            $table->integer('mahasiswa_nim');
            $table->string('mahasiswa_name', 50);
            $table->string('mahasiswa_alamat', 100);
            $table->timestamps();
            $table->softDeletes();
        });
        // Memasukkan data ke dalam tabel mahasiswa
        DB::table('mahasiswa')->insert([
            ['mahasiswa_nim' => 'NIM', 'mahasiswa_nama' => 'Nusa Tenggara Barat', 'created_at' => now(), 'updated_at' => now()],
            ['mahasiswa_nim' => 'NIM', 'mahasiswa_nama' => 'Nusa Tenggara Barat', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
