<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Dealer;
use App\Models\Unit;
use App\Models\Color;
use App\Models\Entry;
use App\Models\Sale;
use App\Models\Leasing;
use App\Models\SaleDelivery;
use App\Models\Manpower;
use App\Models\BranchDelivery;
use App\Models\Opname;
use App\Models\Document;
use App\Models\StockHistory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'dealer_code',
        'email',
        'username',
        'password',
        'access',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi to created, updated Dealer
    public function dealerC(){
        return $this->hasMany(Dealer::class, 'created_by');
    }

    public function dealerU(){
        return $this->hasMany(Dealer::class, 'updated_by');
    }

    // Relasi to created, updated Unit
    public function unitC(){
        return $this->hasMany(Unit::class, 'created_by');
    }

    public function unitU(){
        return $this->hasMany(Unit::class, 'updated_by');
    }

    // Relasi to created, updated Color
    public function colorC(){
        return $this->hasMany(Color::class, 'created_by');
    }

    public function colorU(){
        return $this->hasMany(Color::class, 'updated_by');
    }

    // Relasi to created, updated Entry
    public function entryC(){
        return $this->hasMany(Entry::class, 'created_by');
    }

    public function entryU(){
        return $this->hasMany(Entry::class, 'updated_by');
    }

    // Relasi to created, updated Sale
    public function saleC(){
        return $this->hasMany(Sale::class, 'created_by');
    }

    public function saleU(){
        return $this->hasMany(Sale::class, 'updated_by');
    }

    // Relasi to created, updated Leasing
    public function leasingC(){
        return $this->hasMany(Leasing::class, 'created_by');
    }

    public function leasingU(){
        return $this->hasMany(Leasing::class, 'updated_by');
    }

    // Relasi to created, updated Sale Deliveries
    public function saleDeliveryC(){
        return $this->hasMany(SaleDelivery::class, 'created_by');
    }

    public function saleDeliveryU(){
        return $this->hasMany(SaleDelivery::class, 'updated_by');
    }

    // Relasi to created, updated Manpower
    public function manpowerC(){
        return $this->hasMany(Manpower::class, 'created_by');
    }

    public function manpowerU(){
        return $this->hasMany(Manpower::class, 'updated_by');
    }

    // Relasi to created, updated Branch Deliveries
    public function branchDeliveryC(){
        return $this->hasMany(BranchDelivery::class, 'created_by');
    }

    public function branchDeliveryU(){
        return $this->hasMany(BranchDelivery::class, 'updated_by');
    }

    // Relasi to created, updated Out
    public function outC(){
        return $this->hasMany(Out::class, 'created_by');
    }

    public function outU(){
        return $this->hasMany(Out::class, 'updated_by');
    }

    // Relasi to created, updated Opname
    public function opnameC(){
        return $this->hasMany(Opname::class, 'created_by');
    }

    public function opnameU(){
        return $this->hasMany(Opname::class, 'updated_by');
    }

    // Relasi to created, updated Document
    public function documentC(){
        return $this->hasMany(Document::class, 'created_by');
    }

    public function documentU(){
        return $this->hasMany(Document::class, 'updated_by');
    }

    // Relasi to created, updated History Stock
    public function historyC(){
        return $this->hasMany(StockHistory::class, 'created_by');
    }

    public function historyU(){
        return $this->hasMany(StockHistory::class, 'updated_by');
    }
}
