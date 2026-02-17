<?php

namespace App\Services;

use App\Models\PsichologService;
use Illuminate\Support\Facades\DB;

class PsychologServiceService
{
    public function list()
    {
        return PsichologService::with(['psycholog', 'service'])->get();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            // optional: cegah duplicate kombinasi psycholog + service
            $exists = PsichologService::where('psycholog_id', $data['psycholog_id'])
                ->where('service_id', $data['service_id'])
                ->where('type', $data['type']) // Tambahkan ini
                ->exists();

            if ($exists) {
                throw new \Exception('Service sudah terdaftar untuk psikolog ini.');
            }
            return PsichologService::create([
                'psycholog_id' => $data['psycholog_id'],
                'service_id'   => $data['service_id'],
                'price'        => $data['price'],
                'type'         => $data['type'],
                'is_active'    => $data['is_active'] ?? true,
            ]);
        });
    }

    public function update(PsichologService $psychologService, array $data)
    {
        return DB::transaction(function () use ($psychologService, $data) {

            $psychologService->update([
                'service_id' => $data['service_id'] ?? $psychologService->service_id,
                'price'      => $data['price'] ?? $psychologService->price,
                'is_active'  => $data['is_active'] ?? $psychologService->is_active,
                'type'         => $data['type'] ?? $psychologService->type,
            ]);

            return $psychologService->fresh(['psycholog', 'service']);
        });
    }

    public function delete(PsichologService $psychologService)
    {
        return DB::transaction(function () use ($psychologService) {
            return $psychologService->delete();
        });
    }

    public function toggleStatus(PsichologService $psychologService)
    {
        return DB::transaction(function () use ($psychologService) {

            $psychologService->update([
                'is_active' => !$psychologService->is_active
            ]);

            return $psychologService;
        });
    }
}
