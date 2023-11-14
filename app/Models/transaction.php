<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
        protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'no_transaksi',
        'target_user_id',
        'type',
        'amount'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getNomorTransaksiAttribute()
    {
        $totalRecords = self::count(); // Menghitung total record di tabel

        return 'TR-' . str_pad($totalRecords + 1, 5, '0', STR_PAD_LEFT);
    }
}
