<?php

namespace App\Exports;

use App\Models\Entry;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EntryExport implements FromCollection
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

    public function view(): View{
        return view('export.entry',[
            'data' => Entry::whereBetween('entry_date', [$this->start, $this->end])
            ->orderBy('entry_date','asc')->get()
        ]);
    }
}
