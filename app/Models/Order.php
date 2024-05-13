<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    public function cashier(): BelongsTo
    {
        return $this->belongsTo(User::class, "cashier_id");
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function paymentCompleted(): void
    {
        $this->payment_status = 'completed';

        $this->save();
    }

    public function cancelled(): void
    {
        $this->status = 'cancelled';

        $this->save();
    }

    public function completed(): void
    {
        $this->status = 'completed';

        $this->save();
    }
}
