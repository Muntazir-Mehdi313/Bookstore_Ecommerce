<?php
namespace App\Http\Controllers\Concerns;

trait ExportsCsv
{
    protected function streamCsv($rows, array $headers, string $filenamePrefix)
    {
        $filename = $filenamePrefix . '_' . now()->format('Ymd_His') . '.csv';

        return response()->streamDownload(function () use ($rows, $headers) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $headers);

            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv']);
    }
}