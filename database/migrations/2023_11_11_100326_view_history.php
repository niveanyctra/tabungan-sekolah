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
        //
        DB::statement('DROP VIEW IF EXISTS bukti_transaksi_view');
        DB::statement('
            CREATE VIEW bukti_transaksi_view AS
            SELECT
                users.name AS name,
                transactions.no_transaksi AS no_transaksi,
                transactions.type AS type,
                transactions.amount AS jumlah,
                transactions.created_at AS tanggal
            FROM
                transactions
            INNER JOIN
                users ON transactions.user_id = users.id
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
                DB::statement('DROP VIEW bukti_transaksi_view');
                $this->call('migrate:fresh');
    }
};
