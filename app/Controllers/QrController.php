<?php

namespace App\Controllers;

use App\Models\QrCodeModel;
use CodeIgniter\Controller;

class QrController extends Controller
{
    public function index()
    {
        return view('qr_view');
    }

    public function monitor()
    {
        $model = new QrCodeModel();
        $data['total'] = $model->countAllResults();
        return view('monitor_view', $data);
    }

    public function viewAllData()
    {
        $model = new QrCodeModel();
        $perPage = $this->request->getGet('per_page') ?? 10;
        if ($perPage == 'all') {
            $data['qr_codes'] = $model->findAll();
        } else {
            $data['qr_codes'] = $model->paginate($perPage);
            $data['pager'] = $model->pager;
        }
        $data['total'] = $model->countAllResults();
        $data['perPage'] = $perPage;

        return view('view_all_data_view', $data);
    }

    public function checkRegistration()
    {
        $qrData = $this->request->getPost('qr_data');
        $model = new QrCodeModel();
        if ($model->isRegistered($qrData)) {
            echo 'registered';
        } else {
            echo 'not registered';
        }
    }

    public function processQr()
    {
        $qrData = $this->request->getPost('qr_data');
        $model = new QrCodeModel();
        $deviceInfo = $this->request->getUserAgent()->getAgentString();

        if ($model->isRegistered($qrData)) {
            session()->setFlashdata('error', 'This QR code has already been registered.');
            return redirect()->to('/');
        } else {
            $data = [
                'code_data' => $qrData,
                'device_info' => $deviceInfo,
            ];
            $model->save($data);
            session()->setFlashdata('success', 'QR code registered successfully.');
            return redirect()->to('/');
        }
    }

    public function downloadCsv()
    {
        $model = new QrCodeModel();
        
        // เลือกเฉพาะคอลัมน์ที่ต้องการ
        $qrCodes = $model->select('id, code_data, scan_time, device_info')->findAll();

        $filename = "qr_codes_" . date('Ymd') . ".csv";
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Code Data', 'Scan Time', 'Device Info']);

        foreach ($qrCodes as $qrCode) {
            fputcsv($output, $qrCode);
        }

        fclose($output);
        exit;
    }
}
