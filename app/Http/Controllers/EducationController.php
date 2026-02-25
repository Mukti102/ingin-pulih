<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationRequest;
use App\Models\Education;
use App\Services\EducationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EducationController extends Controller
{
    protected $educationService;

    public function __construct(EducationService $educationService)
    {
        $this->educationService = $educationService;
    }

    public function store(EducationRequest $request)
    {
        try {
            // Gunakan validated() untuk mengambil data yang sudah divalidasi
            $this->educationService->store($request->validated());
            
            toast('Berhasil Menambahkan Pendidikan', 'success');
            return redirect()->back();
        } catch (Exception $th) {
            Log::error('Gagal Menambahkan pendidikan', ['message' => $th->getMessage()]);
            toast('Gagal Menambahkan Pendidikan', 'error');
            return redirect()->back();
        }
    }

    public function update(EducationRequest $request, Education $education)
    {
        try {
            // Kirim model education dan data baru ke service
            $this->educationService->update($education, $request->validated());
            
            toast('Berhasil Memperbarui Pendidikan', 'success');
            return redirect()->back();
        } catch (Exception $th) {
            Log::error('Gagal Memperbarui pendidikan', ['message' => $th->getMessage()]);
            toast('Gagal Memperbarui Pendidikan', 'error');
            return redirect()->back();
        }
    }

    public function destroy(Education $education)
    {
        try {
            $this->educationService->destroy($education);
            
            toast('Berhasil Menghapus Pendidikan', 'success');
            return redirect()->back();
        } catch (Exception $th) {
            Log::error('Gagal Menghapus pendidikan', ['message' => $th->getMessage()]);
            toast('Gagal Menghapus Pendidikan', 'error');
            return redirect()->back();
        }
    }
}