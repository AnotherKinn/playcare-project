<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TransactionDetail extends Component
{
    public $transaction; // Tambahkan ini

    /**
     * Create a new component instance.
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction; // Simpan variabel
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.transaction-detail');
    }
}
