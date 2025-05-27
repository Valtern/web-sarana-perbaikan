<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ReportSummaryExport implements WithMultipleSheets
{
    protected $summaryData;
    protected $damageScores;

    public function __construct(array $summaryData, array $damageScores)
    {
        $this->summaryData = $summaryData;
        $this->damageScores = $damageScores;
    }

    public function sheets(): array
    {
        return [
            new Sheets\SummarySheet($this->summaryData),
            new Sheets\DamageSummarySheet($this->damageScores),
        ];
    }
}

