<?php

namespace App\Services;

use App\Models\Report;

class ReportService
{
    public function createReport(array $data)
    {
        return Report::create($data);
    }
}
