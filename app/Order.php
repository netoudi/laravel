<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'status',
    ];

    protected $options = [
        0 => 'Waiting for Payment',
        1 => 'Product Submitted',
        2 => 'Product Hand',
        3 => 'Cancelled',
    ];

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return isset($this->options[$this->status]) ? $this->options[$this->status] : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
