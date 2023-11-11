<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
DB::unprepared("
            CREATE TRIGGER update_student_profile_jumlah
            AFTER INSERT ON transactions FOR EACH ROW
            BEGIN
                IF NEW.type = 'Setor' THEN
                    UPDATE student_profiles
                    SET jumlah = jumlah + NEW.amount
                    WHERE id = NEW.user_id;
                ELSEIF NEW.type = 'Tarik' THEN
                    UPDATE student_profiles
                    SET jumlah = jumlah - NEW.amount
                    WHERE id = NEW.user_id;
                ELSEIF NEW.type = 'Transfer' THEN
                    UPDATE student_profiles
                    SET jumlah = jumlah - NEW.amount
                    WHERE id = NEW.user_id;
                    UPDATE student_profiles
                    SET jumlah = jumlah + NEW.amount
                    WHERE id = NEW.target_user_id;
                END IF;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared("DROP TRIGGER IF EXISTS update_student_profile_jumlah");

    }
};
