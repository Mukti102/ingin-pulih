<?php

namespace App\Services;

use App\Models\Education;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EducationService
{
    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            // Mengambil ID Psikolog dari user yang sedang login
            $data['psycholog_id'] = Auth::user()->psycholog->id;

            $education = Education::create($data);

            DB::commit(); // Pastikan data disimpan permanen
            return $education;
        } catch (Exception $th) {
            DB::rollBack(); // Batalkan semua jika ada error

            Log::error('Error add education: ' . $th->getMessage(), [
                'user_id' => Auth::id(),
                'data' => $data
            ]);

            return false;
        }
    }

    public function update(Education $education, array $data)
    {
        DB::beginTransaction();
        try {
            // Validasi kepemilikan (security check)
            if ($education->psycholog_id !== Auth::user()->psycholog->id) {
                throw new Exception("Unauthorized access to education record.");
            }

            $education->update($data);

            DB::commit();
            return $education;
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error update education: ' . $th->getMessage(), [
                'education_id' => $education->id,
                'user_id' => Auth::id()
            ]);
            return false;
        }
    }

    /**
     * Hapus data pendidikan
     */
    public function destroy(Education $education)
    {
        DB::beginTransaction();
        try {
            // Validasi kepemilikan
            if ($education->psycholog_id !== Auth::user()->psycholog->id) {
                throw new Exception("Unauthorized access to delete education record.");
            }

            $education->delete();

            DB::commit();
            return true;
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error delete education: ' . $th->getMessage(), [
                'education_id' => $education->id,
                'user_id' => Auth::id()
            ]);
            return false;
        }
    }
}
