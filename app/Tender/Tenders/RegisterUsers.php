<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 02.12.16
 * Time: 14:07
 */
namespace Tender\Tenders;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Tender\User\User;

class RegisterUsers extends Eloquent
{
    protected $table = "registered_members";
    protected $fillable = [
        'uniq_identifier',
        'registered_tender',
        'curent_price',
        'curent_place',
        'company',
        'file_contents',
        'finished'
    ];
    protected $place;
    protected $price;

    public function tenders()
    {
        return $this->belongsTo('Tender\Tenders\Tenders');
    }

    public function placement($user, $tender)
    {

        $total = $this
            ->where('finished', 0)
            ->where('registered_tender', $tender)
            ->orderBy('curent_price', 'ASC')
            ->get();

        foreach ($total as $item => $key) {
            $item = $item + 1;
            $userId = $key['uniq_identifier'];

            $this->where('uniq_identifier', $userId)->where('finished', 0)->update([
                'curent_place' => $item
            ]);
        }
        $userData = $this->where('uniq_identifier', $user)->where('finished', 0)->first();
        if (isset($userData)) {
            $this->price = $userData->curent_price;
            $this->place = $userData->curent_place;
        }

        return array('place' => $this->place, 'price' => $this->price);
    }

    public function getTender($tender)
    {
        return Tenders::where('tender_number', $tender)->first();
    }
}
