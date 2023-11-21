<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProgramsMultiSheetExport implements WithMultipleSheets
{
    use Exportable;

    protected $dateD;
    protected $dateF;

    public function __construct($dateD, $dateF){
        $this->dateF = $dateF;
        $this->dateD = $dateD;
    }

    
    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new ProgramsActivitePrevExport($this->dateD, $this->dateF);
        $sheets[] = new ProgramsActiviteExport($this->dateD, $this->dateF);
        
        return $sheets;
    }
}
