<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Traits\Helpers;
use Livewire\Component;

class SaleProfile extends Component
{
    use Helpers;

    protected $listeners = ['reloadPage' => 'reloadPage'];

    public $sale;
    public $sale_id;
    public $service = "SalesProfileService";

    public $madar = "";
    public $deposit = "";


    public function mount($sale_id)
    {
        $this->sale_id = $sale_id;
        $this->sale = Sale::find($sale_id);
        $this->writeMadarPDF();
        $this->writeDepositPDF();
    }

    public function writeMadarPDF()
    {
        $file = asset('pdfs/madar.pdf');
        $this->madar = $this->setMadarPDF($this->sale_id, $file);
    }

    public function writeDepositPDF()
    {
        $file = asset('pdfs/deposit.pdf');
        $this->deposit = $this->setDepositPDF($this->sale_id, $file);
    }

    public function render()
    {
        return view('livewire.sale-profile');
    }

    public function openModel()
    {
        $this->emit('updater', "SalesProfileService", $this->sale_id);
    }

    public function reloadPage()
    {
        return redirect()->route('panel.sales.profile', ['sale' => $this->sale_id]);
        // $this->deposit = asset('pdf-viewer/web/viewer.html?file=deposit.pdf');
        // $this->madar = asset('pdf-viewer/web/viewer.html?file=madar.pdf');
        // $this->emit('set-pdf-file', asset('pdfs/deposit.pdf'), "#madar");
        // $this->emit('set-pdf-file', asset('pdf-viewer/web/viewer.html?file=madar.pdf'), "#madar");
    }
}
