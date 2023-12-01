<?php 

namespace App\Helpers;

use Illuminate\Support\Carbon;

class DateHelper
{
    public static function parseDateRange($dateRange)
    {
        try {
            $dates = explode(' - ', $dateRange);

            $startDate = Carbon::createFromFormat('m/d/Y', $dates[0])->toDateString();
            $endDate = Carbon::createFromFormat('m/d/Y', $dates[1])->toDateString();

            return [
                'tgl_mulai' => $startDate,
                'tgl_selesai' => $endDate,
            ];
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public static function mergeDateRange($startDate, $endDate)
    {
        $startDate = Carbon::parse($startDate)->format('d/m/Y');
        $endDate = Carbon::parse($endDate)->format('d/m/Y');

        return $startDate . ' - ' . $endDate;
    }
}
?>