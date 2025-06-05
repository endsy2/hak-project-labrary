<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'first_name',
        'last_name',
        'address',
        'book_id',
        'mobile_phone',
        'member_type',
        'book_status',
        'borrow_date',
        'due_date',
        'return_date',
    ];
}

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class Borrower extends Model
// {
//     protected $table = 'borrowers';

//     protected $fillable = [
//         'member_id',
//         'first_name',
//         'last_name',
//         'address',
//         'book_id',
//         'mobile_phone',
//         'member_type',
//         'book_status',
//         'borrow_date',
//         'due_date',
//         'return_date',
//     ];
// }
