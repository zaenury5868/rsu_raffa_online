<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class VisitPatient extends Component
{
    public $search = '';
    public $isLoading = true;

    public function render() {
        try {
            $this->isLoading = true;
            
            return view('livewire.visit-patient');
        } catch (\Exception $e) {
            return response('Terjadi kesalahan: ' . $e->getMessage(), 500);
        } finally {
            $this->isLoading = false;
        }
    }
}
