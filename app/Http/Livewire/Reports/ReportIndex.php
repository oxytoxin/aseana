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
        try {
            $date_from = Carbon::parse($this->date_from);
            $date_to = Carbon::parse($this->date_to)->addDay();
            $this->transactions = Transaction::with('products')->where('is_final', true)->whereBetween('updated_at', [$date_from, $date_to])->get();
        } catch (\Throwable $th) {
        }
        return view('livewire.reports.report-index')
            ->extends('layouts.master')
            ->section('content');
    }
    public function export()
    {
        return Excel::download(new SalesExport($this->transactions), "sales_report_$this->date_from-$this->date_to.xlsx");
    }

    public function printReport()
    {
        try {
            $date_from = Carbon::parse($this->date_from);
            $date_to = Carbon::parse($this->date_to)->addDay();
            return redirect()->route('print-report', ['date_from' => $this->date_from, 'date_to' => $this->date_to]);
        } catch (\Throwable $th) {
        }
    }
}