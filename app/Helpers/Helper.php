<?php
namespace App\Helpers;
use App\Models\outgoing;

class Helper
{

    public static function IDGenerator($model, $trow, $length = 2, $prefix)
    {
        $data = $model::orderBy('nomor_surat', 'desc')->first();
        if (!$data) {
            $og_length = $length;
            $last_number = '1';
        } else {
            $code = (int)(substr($data->$trow, strlen($prefix)+1));
            $actial_last_number = (int)($code / 1) * 1;
            $increment_last_number = $actial_last_number + 1;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;
        }

        $zeros = '';
        for ($i = 0; $i < $og_length; $i++) {
            $zeros .= '0';
        }

        return $prefix . '-' . $zeros . $last_number;
    }

    public static function IDGenerator2($model, $trow, $length = 2, $prefix)
    {
        $data = $model::orderBy('nomor_surat', 'desc')->first();
        if (!$data) {
            $og_length = $length;
            $last_number = '1';
        } else {
            $code = (int)(substr($data->$trow, strlen($prefix)+1));
            $actial_last_number = (int)($code / 1) * 1;
            $increment_last_number = $actial_last_number + 1;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;
        }

        $zeros = '';
        for ($i = 0; $i < $og_length; $i++) {
            $zeros .= '0';
        }

        // return $zeros . $last_number . '/' . $prefix;
        return $prefix . '-' . $zeros . $last_number;
    }

    public static function generateAutoIncrement()
    {
        $lastRecord = outgoing::orderBy('nomor_surat', 'desc')->first();
        if ($lastRecord) {
            $lastNumber = (int) substr($lastRecord->nomor_surat, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $formattedNumber = str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        return $formattedNumber;
    }


}
?>
