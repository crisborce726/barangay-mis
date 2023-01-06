<?php

namespace App\Exports;

use App\Models\Barangay;
use App\Models\Resident;
use App\Models\ResidentSector;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use Carbon\Carbon;

class ResidentsExport implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $excelExport = Resident::join('barangays', 'barangays.id', '=', 'residents.barangay_id')
                                ->select(
                                    "residents.id", 
                                    "residents.household_no", 
                                    "residents.lastname", 
                                    "residents.firstname", 
                                    "residents.middlename", 
                                    "residents.suffix", 
                                    "residents.birth_date", 
                                    "residents.gender", 
                                    "residents.phone_number",
                                    "residents.sitio",
                                    "barangays.barangay"
                                    )->get()
                                ->groupBy('barangays.barangay')
                                ->sortBy('lastname');

        return $excelExport;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [
            "ID",
            "HOUSEHOLD NO.",
            "LASTNAME",
            "FIRSTNAME",
            "MIDDLENAME",
            "SUFFIX",
            "BIRTHDAY",
            "GENDER",
            "PHONE NO.",
            "SITIO",
            "BARANGAY",
        ];
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function (AfterSheet $event) {

                $event->sheet->getDelegate()->getStyle('A1:K1')
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFA500');
              
                 $event->sheet->getDelegate()->freezePane('A2');  
            },

        ];
    }
}