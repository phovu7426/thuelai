<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookBorrowTicketDetail extends Model
{
    protected $fillable = ['book_borrow_ticket_id', 'book_id', 'quantity', 'returned_quantity', 'status', 'note'];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(BookBorrowTicket::class, 'book_borrow_ticket_id');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function returnDetails(): HasMany
    {
        return $this->hasMany(BookReturnTicketDetail::class);
    }
}
