<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Type;
use App\Models\Wilayah;
use App\Models\Topic; // Pastikan import Model Topic
use Illuminate\Support\Facades\Auth;

class PsychologistProfileUpdate extends Component
{
    public $fullname, $about, $wilayah_id, $jenis_psikolog, $SIPP, $STR, $experience_years;

    // Properti untuk menampung ID topik yang dipilih
    public $selectedTopics = [];

    public function mount()
    {
        $psycholog = Auth::user()->psycholog;

        $this->fullname = $psycholog->fullname;
        $this->about = $psycholog->about;
        $this->wilayah_id = $psycholog->wilayah_id;
        $this->jenis_psikolog = $psycholog->jenis_psikolog;
        $this->SIPP = $psycholog->SIPP;
        $this->STR = $psycholog->STR;
        $this->experience_years = $psycholog->experience_years;

        // Ambil ID topik yang sudah dimiliki psikolog saat ini
        $this->selectedTopics = $psycholog->topics->pluck('id')->map(fn($id) => (string)$id)->toArray();
    }

    public function update()
    {
        $this->validate([
            'fullname' => 'required|string|max:255',
            'about' => 'required|string',
            'wilayah_id' => 'required|exists:wilayahs,id',
            'jenis_psikolog' => 'required|exists:types,id',
            'experience_years' => 'required|integer|min:0',
            'selectedTopics' => 'required|array|min:1', // Minimal pilih 1 topik
        ]);

        try {
            $psycholog = Auth::user()->psycholog;

            // 1. Update Data Utama
            $psycholog->update([
                'fullname' => $this->fullname,
                'about' => $this->about,
                'wilayah_id' => $this->wilayah_id,
                'jenis_psikolog' => $this->jenis_psikolog,
                'SIPP' => $this->SIPP,
                'STR' => $this->STR,
                'experience_years' => $this->experience_years,
            ]);

            // 2. Sinkronisasi Topik (Many-to-Many)
            // sync() akan otomatis menambah yang baru dan menghapus yang tidak dicentang
            $psycholog->topics()->sync($this->selectedTopics);

            $this->dispatch('success-toast', message: 'Berhasil Memperbarui Data Profesional');
        } catch (\Exception $e) {
            $this->dispatch('error-toast', message: 'Gagal memperbarui data');
        }
    }

    public function render()
    {
        return view('livewire.psychologist-profile-update', [
            'types' => Type::all(),
            'wilayahs' => Wilayah::all(),
            'allTopics' => Topic::orderBy('name', 'asc')->get(),
        ]);
    }
}
