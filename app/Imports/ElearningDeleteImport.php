<?php

namespace App\Imports;

use App\Models\ElearningDelete;
use Maatwebsite\Excel\Concerns\ToModel;

class ElearningDeleteImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ElearningDelete([
            'nim' => $row[0],
        ]);
    }
}
