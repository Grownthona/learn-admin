<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryUser extends Model
{
    use HasFactory;
    protected $table = 'inventoryusers';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
