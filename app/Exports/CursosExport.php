<?php

namespace App\Exports;

use App\Models\Curso;
use App\Models\Inscripcione;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;

class CursosExport implements FromCollection,WithHeadings, WithCustomStartCell, WithStyles, WithColumnWidths, WithTitle
{

    public $data;
    public function __construct($id)
    {
        $this->data = $id;
    }

    public function headings(): array
    {
        return [
            'id',
            'Cedula',
            'Nombres',
            'Apellidos',
            'Correo',
            'Teléfono',
            'Empresa Telefónica',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         $resultado =Inscripcione::join("planificaciones", "inscripciones.planificacione_id" , "=", "planificaciones.id")
         ->join ("estudiantes","inscripciones.estudiante_id", "=", "estudiantes.id")
         ->join ("cursos","planificaciones.curso_id", "=", "cursos.id")
         ->where("inscripciones.planificacione_id", $this->data)
         ->get("estudiantes.*");
         
         return $resultado;
    }
    public function startCell(): string
    {
        return 'B2';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            2    => ['font' => ['bold' => true], 'color' => array('rgb' => 'FF0000')],
           
            // Styling a specific cell by coordinate.
            'B' => ['font' => ['size' => 12],'alignment' => ['horizontal' => 'center'] ],
        
            // Styling an entire column.
            'C'  => ['font' => ['size' => 12],'alignment' => ['horizontal' => 'center']],

            'D'  => ['font' => ['size' => 12],'alignment' => ['horizontal' => 'center']],

            'E'  => ['font' => ['size' => 12],'alignment' => ['horizontal' => 'center']],

            'F'  => ['font' => ['size' => 12],'alignment' => ['horizontal' => 'center']],
            'G'  => ['font' => ['size' => 12],'alignment' => ['horizontal' => 'center']],
            'H'  => ['font' => ['size' => 12],'alignment' => ['horizontal' => 'center']],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'C' => 20,
            'D' => 30,
            'E' => 30,
            'F' => 40,
            'G' => 15,
            'H' => 22,
       
        ];
    }

    public function title(): string
    {
        
        return 'Litado de estudiantes';
    }
}
