<?php

namespace App\Exports;

use App\Models\Entry;
use App\Models\Sale;
use App\Models\Out;
use App\Models\SaleDelivery;
use App\Models\BranchDelivery;
use App\Models\Document;
use App\Models\StockHistory;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ReportExport implements FromView
{
    use Exportable;

    public function start(string $start)
    {
        $this->start = $start;
        return $this;
    }

    public function end(string $end)
    {
        $this->end = $end;
        return $this;
    }

    public function param(string $param){
        $this->param = $param;
        return $this;
    }

    public function view(): View{
        if ($this->param == 'entry') {
            return view('export.entry',[
                'data' => Entry::whereBetween('entry_date', [$this->start, $this->end])
                ->orderBy('entry_date','asc')->get()
            ]);
        }elseif($this->param == 'sale') {
            return view('export.sale',[
                'data' => Sale::whereBetween('sale_date', [$this->start, $this->end])
                ->orderBy('sale_date','asc')->get()
            ]);
        }elseif($this->param == 'out') {
            return view('export.out',[
                'data' => Out::whereBetween('out_date', [$this->start, $this->end])
                ->orderBy('out_date','asc')->get()
            ]);
        }elseif($this->param == 'sale-delivery') {
            return view('export.sale-delivery',[
                'data' => SaleDelivery::whereBetween('sale_delivery_date', [$this->start, $this->end])
                ->orderBy('sale_delivery_date','asc')->get()
            ]);
        }elseif($this->param == 'branch-delivery') {
            return view('export.branch-delivery',[
                'data' => BranchDelivery::whereBetween('branch_delivery_date', [$this->start, $this->end])
                ->orderBy('branch_delivery_date','asc')->get()
            ]);
        }elseif($this->param == 'stock-history') {
            return view('export.stock-history',[
                'data' => StockHistory::whereBetween('history_date', [$this->start, $this->end])
                ->orderBy('history_date','asc')->get()
            ]);
        }elseif($this->param == 'document') {
            return view('export.document',[
                'data' => Document::join('sales','documents.sale_id','sales.id')
                ->whereBetween('sale_date', [$this->start, $this->end])
                ->orderBy('sale_date','asc')->get()
            ]);
        }else{
            return view('export.error');
        }
    }
}
