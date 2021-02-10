<?php

namespace App\Http\Livewire\Reports;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Transaction;
use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportIndex extends Component
{
    public $date_to;
    public $date_from;
    public $transactions;
    public function mount()
    {
        session(['page' => 'reports.index']);
        $this->date_to = Carbon::now();
        $this->date_from = Carbon::now();
    }

    public function render()
    {
        $this->transactions = Transaction::with('products')->where('is_final', true)->whereBetween('updated_at', [Carbon::parse($this->date_from), Carbon::parse($this->date_to)->addDay()])->get();
        return view('livewire.reports.report-index')
            ->extends('layouts.master')
            ->section('content');
    }
    public function export()
    {
        return Excel::download(new SalesExport($this->transactions), "sales_report_$this->date_from-$this->date_to.xlsx");
    }
}