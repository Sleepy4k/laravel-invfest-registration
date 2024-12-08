<?php

namespace App\Foundations;

use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

class Export implements WithHeadings, WithEvents
{
    use RegistersEventListeners;

    /**
     * Headings for the sheet
     *
     * @var array
     */
    protected array $headings = [];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return $this->headings;
    }

    /**
     * Convert column index to letter
     *
     * @param int $index
     *
     * @return string
     */
    private function getColumnLetter(int $index): string
    {
        $letter = '';

        while ($index > 0) {
            $index--;
            $letter = chr(65 + ($index % 26)) . $letter;
            $index = (int)($index / 26);
        }

        return $letter;
    }

    /**
     * Get style coordinate based on headings
     *
     * @return string|null
     */
    private function getStyleCoordinateBasedOnHeadings(): string|null
    {
        $coordinate = 'A1';
        $headings = $this->headings;

        if (empty($headings)) {
            return null;
        }

        if (count($headings) === 1) {
            return $coordinate;
        }

        return $coordinate.':'.$this->getColumnLetter(count($headings)).'1';
    }

    /**
     * Styling for the sheet
     *
     * @param AfterSheet $event
     */
    public function afterSheet(AfterSheet $event)
    {
        $sheet = $event->sheet->getDelegate();
        $coordinate = $this->getStyleCoordinateBasedOnHeadings();

        if (is_null($coordinate)) return;

        $sheet->getStyle($coordinate)
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB(Color::COLOR_YELLOW);

        $sheet->getStyle($coordinate)
            ->getFont()
            ->setSize(16)
            ->setBold(true);
    }
}
