<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id',
        'receipt',
        'user_id',
        'level_id',
        'status',
        'payment_status',
        'amount'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    public function getStatusAttribute($value)
    {
        return $value === 'pending' ? 'Pending' : 'Completed';
    }
    public function getPaymentStatusAttribute($value)
    {
        return $value === 'unpaid' ? 'Unpaid' : 'Paid';
    }
    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount, 2);
    }
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('d-m-Y H:i:s');
    }
    public function getFormattedUpdatedAtAttribute()
    {
        return $this->updated_at->format('d-m-Y H:i:s');
    }
}
