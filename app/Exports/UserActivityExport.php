<?php

namespace App\Exports;

use App\Models\User;
use Spatie\Activitylog\Models\Activity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserActivityExport implements FromCollection, WithHeadings
{
    protected $activities;

    public function __construct($activities)
    {
        $this->activities = $activities;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Transformasi data aktivitas pengguna ke dalam bentuk yang sesuai untuk diekspor
        $data = $this->activities->map(function ($activity) {
            return [
                'Log Name' => $activity->log_name,
                'Description' => $activity->description,
                'Subject' => $activity->subject ? $activity->subject->name : null,
                'Causer' => $activity->causer ? $activity->causer->name : null,
                'Created At' => $activity->created_at,
            ];
        });

        return $data;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Log Name',
            'Description',
            'Subject',
            'Causer',
            'Created At',
        ];
    }
}
