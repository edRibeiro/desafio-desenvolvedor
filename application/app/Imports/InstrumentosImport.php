<?php

namespace App\Imports;

use App\Models\Instrumento;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithStartRow;

class InstrumentosImport implements ToModel, WithProgressBar, WithHeadingRow, WithBatchInserts, WithChunkReading, ShouldQueue, WithCustomCsvSettings
{
    use Importable;

    public function __construct(private int $fileId) {}

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            $obj =
                new Instrumento([
                    'RptDt' => $row['rptdt'],
                    'TckrSymb' => $row['tckrsymb'],
                    'SctyCtgyNm' => $row['sctyctgynm'],
                    'ISIN' => $row['isin'],
                    'CrpnNm' => $row['crpnnm'],
                    'file_id' => $this->fileId
                ]);
            return $obj;
        } catch (\Exception $e) {
            Log::error('Erro ao importar linha: ', ['row' => $row, 'error' => $e->getMessage()]);
            return null; // Pula o registro problemático
        }
    }
    public function headingRow(): int
    {
        return 2;
    }

    public function batchSize(): int
    {
        return 200;
    }

    public function chunkSize(): int
    {
        return 200;
    }
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
}
