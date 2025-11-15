<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedeemRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'jumlah_poin',
        'nominal',
        'bank',
        'no_rekening',
        'atas_nama',
        'bukti_tf',
        'catatan_admin',
        'status', 

    ];


    public function user()
{
    return $this->belongsTo(User::class);
}

}
