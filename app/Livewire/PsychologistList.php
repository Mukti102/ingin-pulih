<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class PsychologistList extends Component
{

    use WithPagination;
    public $search = '';
    public $day = '';
    public $selectedDate = '';
    public $selectedServices = [];
    public $selectedWilayahs = [];
    public $selectedTypes = [];
    public $selectedTopics = [];


    public function semuaJadwal() // reset
    {
        $this->selectedDate = '';
    }

    public function render()
    {
        // Menggunakan eager loading (with) agar tidak terkena masalah N+1 Query
        $psychologists = \App\Models\Psycholog::with(['user', 'jenisPsikolog', 'topics'])
            ->when($this->search, function ($query) {
                $query->where('fullname', 'like', '%' . $this->search . '%')->orWhere('about', 'like', '%' . $this->search . '%')->orWhereHas('topics', function ($subQ) {
                    $subQ->where('name', 'like', '%' . $this->search . '%');
                });;
            })
            ->when(!empty($this->selectedTypes), function ($query) {
                $query->whereIn('jenis_psikolog', $this->selectedTypes);
            })
            ->when(!empty($this->selectedWilayahs), function ($query) {
                $query->whereIn('wilayah_id', $this->selectedWilayahs);
            })
            ->when(!empty($this->selectedTopics), function ($query) {
                $query->whereHas('topics', function ($q) {
                    $q->whereIn('topics.id', $this->selectedTopics);
                });
            })
            // filter berdasarkan tanggal / hari yg ready
            ->when($this->selectedDate || $this->day, function ($query) {
                $targetDays = [];
                $specificDate = null;

                // 1. Cek jika input dari Flatpickr (bisa tunggal atau range)
                if ($this->selectedDate) {
                    if (str_contains($this->selectedDate, ' to ')) {
                        // Range Date Logic
                        $range = explode(' to ', $this->selectedDate);
                        $startDate = \Carbon\Carbon::parse($range[0]);
                        $endDate = \Carbon\Carbon::parse($range[1]);

                        // Ambil daftar hari apa saja dalam range tersebut (misal: senin & selasa)
                        $current = $startDate->copy();
                        while ($current <= $endDate) {
                            $targetDays[] = strtolower($current->format('l'));
                            $current->addDay();
                        }
                    } else {
                        // Single Date Logic
                        $specificDate = \Carbon\Carbon::parse($this->selectedDate);
                        $targetDays[] = strtolower($specificDate->format('l'));
                    }
                }

                // 2. Jika input dari Dropdown Hari (day)
                if ($this->day) {
                    $targetDays = [$this->day];
                }

                // Eksekusi Filter ke Database
                $query->whereHas('weeklySchedules', function ($q) use ($targetDays) {
                    $q->whereIn('day_of_week', $targetDays)->where('is_active', true);
                });

                if ($specificDate) {
                    $query->whereDoesntHave('booking', function ($q) use ($specificDate) {
                        $q->whereDate('session_date', $specificDate->format('Y-m-d'))
                            ->whereIn('status', ['confirmed', 'complete']);
                    });
                }
            })
            ->latest()
            ->paginate(10);

        return view('livewire.psychologist-list', [
            'psychologists' => $psychologists,
            'services' => Service::all(),
            'types' => \App\Models\Type::all(),
            'wilayahs' => \App\Models\Wilayah::all(),
            'topics' => \App\Models\Topic::all(),
        ]);
    }
}
