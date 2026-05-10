<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $fillable = ['member_id', 'book_id', 'borrow_date', 'due_date', 'return_date', 'status'];

    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function book() {
        return $this->belongsTo(Book::class);
    }

    public function penalty() {
        return $this->hasOne(Penalty::class);
    }
}
