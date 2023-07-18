<?php

namespace App\Http\Livewire;

use App\Traits\Helpers;
use Livewire\Component;

class PDFService extends Component
{
    use Helpers;

    protected $listeners = ['pdf', 'pdfRefresh' => '$refresh', 'writePDF' => 'writePDF'];

    public $model;
    public $file;
    public $pdf_id = '';

    public function mount($model, $file)
    {
        $this->model = $model;
        $this->file = $file;
        $this->pdf_id = $file;
        $this->writePDF();
    }

    public function writePDF()
    {
        if ($this->file == "madar") {
            $file = asset('pdfs/madar.pdf');
            $this->file = $this->setMadarPDF($this->model, $file);
            $this->emit('set-pdf-file', $this->file, "#" . $this->pdf_id);
        }
    }

    public function render()
    {
        return view('livewire.p-d-f-service');
    }
}
