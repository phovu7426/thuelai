<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookReturnTicketDetail extends Model
{
    protected $fillable = ['book_return_ticket_id', 'book_borrow_ticket_detail_id', 'book_id', 'quantity', 'note'];

    public function ticket() {
        return $this->belongsTo(BookReturnTicket::class, 'book_return_ticket_id');
    }

    public function borrowDetail(): BelongsTo
    {
        return $this->belongsTo(BookBorrowTicketDetail::class, 'book_borrow_ticket_detail_id');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
