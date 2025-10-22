<?php

namespace App\Observers;

use App\Models\CompanyOrder;
use Illuminate\Support\Str;

class CompanyOrderObserver
{
    /**
     * Handle the CompanyOrder "created" event.
     */
    public function created(CompanyOrder $companyOrder): void
    {
        $number = random_int(1, 999999999);
        $padded = Str::padLeft($number, 9, 0);
        $reference = 'BST#'.$padded;

        $companyOrder->update([
            'reference' => $reference,
        ]);
    }

    /**
     * Handle the CompanyOrder "updated" event.
     */
    public function updated(CompanyOrder $companyOrder): void
    {
        //
    }

    /**
     * Handle the CompanyOrder "deleted" event.
     */
    public function deleted(CompanyOrder $companyOrder): void
    {
        //
    }

    /**
     * Handle the CompanyOrder "restored" event.
     */
    public function restored(CompanyOrder $companyOrder): void
    {
        //
    }

    /**
     * Handle the CompanyOrder "force deleted" event.
     */
    public function forceDeleted(CompanyOrder $companyOrder): void
    {
        //
    }
}
