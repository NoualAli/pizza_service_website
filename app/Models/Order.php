<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use CrudTrait, SoftDeletes, Notifiable;

    protected $fillable = [
        'restaurant_id',
        'user_id',
        'lastname',
        'firstname',
        'phone',
        'email',
        'order_type',
        'tax',
        'subtotal',
        'total',
        'delivery_fee',
        'payment_method',
        'payed',
        'location',
        'state',
    ];

    public $with = ['lines'];

    /**
     * Getters
     */
    public function getPrintViewAttribute()
    {
        return "crud::operations.order_ticket";
    }
    public function getFirstnameAttribut($firstname)
    {
        return ucfirst(strtolower($firstname));
    }
    public function getLastnameAttribut($lastname)
    {
        return ucfirst(strtolower($lastname));
    }
    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }
    public function getCreatedAtAttribute($created_at)
    {
        return Carbon::parse($created_at)->format('Y-m-d H:i');
    }
    public function getOrderTypeAttribute($orderType)
    {
        return ucfirst(str_replace('-', ' ', $orderType));
    }

    public function getSubtotalAttribute($subtotal)
    {
        return number_format($subtotal, 2) . EURO_SIGN;
    }

    public function getTotalAttribute($total)
    {
        return number_format($total, 2) . EURO_SIGN;
    }

    public function getTaxAttribute($tax)
    {
        return number_format($tax, 2) . EURO_SIGN;
    }

    public function getAddressAttribute()
    {
        $location = json_decode($this->location);
        return $this->order_type == 'Delivery' ? $location->street . ' ' . $location->entrance  . ', ' . $location->postal_code . ', ' . $location->city . ', ' . $this->appartment_number : null;
    }

    public function getAppartmentNumberAttribute()
    {
        $location = json_decode($this->location);
        return $this->order_type == 'Delivery' ? $location->appartment_number : null;
    }

    public function getPhoneAttribute($phone)
    {
        return '+358' . $phone;
    }

    /**
     * Crud Operations
     */
    public function accept($crud = false)
    {
        return $this->state == 'pending' ? '<a class="btn btn-sm btn-link" href="' . url('ps/update-order-state/?order_id=' . $this->id . '&state=accepted') . '" data-toggle="tooltip" title="Just a demo custom button."><i class="la la-check"></i> Accept</a>' : null;
    }

    public function deny($crud = false)
    {
        return $this->state == 'pending' ? '<a class="btn btn-sm btn-link" href="' . url('ps/update-order-state/?order_id=' . $this->id . '&state=denied') . '" data-toggle="tooltip" title="Just a demo custom button."><i class="la la-times-circle"></i> Deny</a>' : null;
    }

    public function ready($crud = false)
    {
        return $this->state == 'accepted' ? '<a class="btn btn-sm btn-link" href="' . url('ps/update-order-state/?order_id=' . $this->id . '&state=ready') . '" data-toggle="tooltip" title="Just a demo custom button."><i class="la la-check"></i> Ready</a>' : null;
    }

    public function deliver($crud = false)
    {
        return $this->state == 'ready' ? '<a class="btn btn-sm btn-link" href="' . url('ps/update-order-state/?order_id=' . $this->id . '&state=delivered') . '" data-toggle="tooltip" title="Just a demo custom button."><i class="la la-check"></i> Deliver</a>' : null;
    }

    public function reset($crud = false)
    {
        return $this->state !== 'pending' ? '<a class="btn btn-sm btn-link" href="' . url('ps/update-order-state/?order_id=' . $this->id . '&state=pending') . '" data-toggle="tooltip" title="Just a demo custom button."><i class="la la-undo-alt"></i> Reset</a>' : null;
    }

    /**
     * Relationships
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function lines()
    {
        return $this->hasMany(OrderLine::class);
    }
}