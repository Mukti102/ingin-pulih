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
    public $fromDateToDate = '';


    public function semuaJadwal() // reset
    {
        $this->selectedDate = '';
    }

    // Di dalam class PsychologistList
    public function updatedFromDateToDate($value)
    {
        // Reset halaman pagination ke 1 setiap kali filter berubah
        $this->resetPage();

        // Opsional: otomatis pilih tanggal pertama dari range tersebut
        if (str_contains($value, ' to ')) {
            $range = explode(' to ', $value);
            $this->selectedDate = $range[0];
        }
    }

    public function render()
    {

        $startDisplay = now();
        $endDisplay = now()->addDays(6); // Default 7 hari

        if ($this->fromDateToDate && str_contains($this->fromDateToDate, ' to ')) {
            $rangeParts = explode(' to ', $this->fromDateToDate);
            $startDisplay = \Carbon\Carbon::parse($rangeParts[0]);
            $endDisplay = \Carbon\Carbon::parse($rangeParts[1]);
        }

        $daysCount = $startDisplay->diffInDays($endDisplay) + 1;

        $psychologists = \App\Models\Psycholog::with(['user', 'jenisPsikolog', 'topics', 'weeklySchedules'])
            ->where('verification_status', 'complete')
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

                if ($this->selectedDate) {
                    if (str_contains($this->selectedDate, ' to ')) {
                        $range = explode(' to ', $this->selectedDate);
                        $startDate = \Carbon\Carbon::parse($range[0]);
                        $endDate = \Carbon\Carbon::parse($range[1]);

                        $current = $startDate->copy();
                        while ($current <= $endDate) {
                            $targetDays[] = strtolower($current->format('l'));
                            $current->addDay();
                        }
                    } else {
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
            ->when($this->selectedDate || $this->fromDateToDate, function ($query) {
                $targetDays = [];
                $specificDate = null;

                // Jika user mengklik tanggal spesifik di Horizontal Calendar
                if ($this->selectedDate) {
                    $specificDate = \Carbon\Carbon::parse($this->selectedDate);
                    $targetDays[] = strtolower($specificDate->format('l'));
                }
                // Jika tidak ada tanggal spesifik, tapi ada range dari Flatpickr
                elseif ($this->fromDateToDate && str_contains($this->fromDateToDate, ' to ')) {
                    $range = explode(' to ', $this->fromDateToDate);
                    $start = \Carbon\Carbon::parse($range[0]);
                    $end = \Carbon\Carbon::parse($range[1]);

                    $current = $start->copy();
                    while ($current <= $end) {
                        $targetDays[] = strtolower($current->format('l'));
                        $current->addDay();
                    }
                }

                // Jalankan Filter ke Database
                $query->whereHas('weeklySchedules', function ($q) use ($targetDays) {
                    $q->whereIn('day_of_week', array_unique($targetDays))->where('is_active', true);
                });

                // Jika memilih tanggal spesifik, cek ketersediaan booking (Anti Bentrok)
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
            'startDate' => $startDisplay,
            'daysCount' => $daysCount,
            'types' => \App\Models\Type::all(),
            'wilayahs' => \App\Models\Wilayah::all(),
            'topics' => \App\Models\Topic::all(),
        ]);
    }
}
