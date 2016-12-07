<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 29.11.16
 * Time: 11:13
 */

namespace Tender\Tenders;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Tender\Tenders\RegisterUsers as Register;

class Tenders extends Eloquent
{
    protected $table = "tenders";
    protected $fillable = [
        'tender_number',
        'purchase_organizer',
        'purchase_category',
        'product_category',
        'purchase_description',
        'price',
        'start_date',
        'end_date',
        'file_contents',
        'winner',
        'update_reason'
    ];

}
