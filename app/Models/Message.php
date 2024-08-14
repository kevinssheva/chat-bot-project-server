<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // Jika Anda ingin menggunakan nama kolom yang berbeda untuk timestamps default Laravel
    // Anda dapat menambahkan baris berikut (opsional):
    // const CREATED_AT = 'createdAt';
    // const UPDATED_AT = null; // Menonaktifkan kolom updated_at jika tidak digunakan

    protected $fillable = [
        'question',
        'answer',
        'createdAt', // Tambahkan 'createdAt' jika ingin mengisi kolom ini secara massal
    ];

    // Jika Anda menggunakan createdAt dan bukan timestamp default Laravel, Anda perlu menonaktifkan timestamps otomatis:
    public $timestamps = false;
}
