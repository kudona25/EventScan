<?php

namespace App\Models;

use CodeIgniter\Model;

class QrCodeModel extends Model
{
    protected $table = 'qr_codes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['code_data', 'scan_time', 'device_info'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function isRegistered($codeData)
    {
        return $this->where('code_data', $codeData)->first() !== null;
    }
}