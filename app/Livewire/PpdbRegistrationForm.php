<?php

namespace App\Livewire;

use App\Models\PpdbRegistration;
use App\Settings\GeneralSettings;
use Livewire\Component;
use Livewire\WithFileUploads;

class PpdbRegistrationForm extends Component
{
    use WithFileUploads;

    public int $currentStep = 1;
    public int $totalSteps = 5;

    // Step 1: Data Diri
    public string $full_name = '';
    public string $nisn = '';
    public string $nik = '';
    public string $gender = 'L';
    public string $birth_place = '';
    public string $birth_date = '';
    public string $religion = 'Islam';
    public string $address = '';
    public string $phone_number = '';

    // Step 2: Orang Tua / Wali
    public string $father_name = '';
    public string $father_occupation = '';
    public string $mother_name = '';
    public string $mother_occupation = '';
    public string $parent_income = '< Rp 3.000.000';
    public string $parent_phone = '';

    // Step 3: Sekolah Asal & Peminatan
    public string $previous_school_name = '';
    public string $previous_school_address = '';
    public string $average_score = '';
    public string $chosen_major = 'MIPA (Matematika & IPA)';

    // Step 4: Berkas Dokumen
    public $file_photo;
    public $file_kk;
    public $file_birth_certificate;
    public $file_report_or_diploma;

    // State
    public string $activeTab = 'register'; // 'register' or 'check_status'
    public string $searchRegNumber = '';
    public ?PpdbRegistration $searchedApplicant = null;
    public ?string $searchError = null;

    public bool $agreement = false;
    public bool $isSubmitted = false;
    public ?string $registrationNumber = null;
    public ?PpdbRegistration $registeredData = null;

    public function checkStatus(): void
    {
        $this->searchError = null;
        $this->searchedApplicant = null;

        $this->validate([
            'searchRegNumber' => 'required|string|min:3',
        ]);

        $search = trim($this->searchRegNumber);
        $applicant = PpdbRegistration::where('registration_number', $search)
            ->orWhere('nisn', $search)
            ->first();

        if ($applicant) {
            $this->searchedApplicant = $applicant;
        } else {
            $this->searchError = 'Data pendaftar dengan nomor "' . $search . '" tidak ditemukan. Pastikan nomor registrasi atau NISN sudah sesuai.';
        }
    }

    public function switchTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->searchError = null;
        $this->searchedApplicant = null;
    }

    protected function rulesForStep(int $step): array
    {
        return match ($step) {
            1 => [
                'full_name' => 'required|string|min:3|max:100',
                'nisn' => 'required|numeric|digits:10',
                'nik' => 'nullable|numeric|digits:16',
                'gender' => 'required|in:L,P',
                'birth_place' => 'required|string|max:50',
                'birth_date' => 'required|date',
                'religion' => 'required|string',
                'address' => 'required|string|min:10',
                'phone_number' => 'required|string|min:10|max:15',
            ],
            2 => [
                'father_name' => 'required|string|min:3',
                'father_occupation' => 'nullable|string',
                'mother_name' => 'required|string|min:3',
                'mother_occupation' => 'nullable|string',
                'parent_income' => 'nullable|string',
                'parent_phone' => 'required|string|min:10',
            ],
            3 => [
                'previous_school_name' => 'required|string|min:3',
                'previous_school_address' => 'nullable|string',
                'average_score' => 'nullable|numeric|between:0,100',
                'chosen_major' => 'nullable|string',
            ],
            4 => [
                'file_photo' => 'nullable|image|max:2048', // 2MB
                'file_kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:3072',
                'file_birth_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:3072',
                'file_report_or_diploma' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:3072',
            ],
            5 => [
                'agreement' => 'accepted',
            ],
            default => [],
        };
    }

    public function nextStep(): void
    {
        $this->validate($this->rulesForStep($this->currentStep));
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function prevStep(): void
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function goToStep(int $step): void
    {
        if ($step < $this->currentStep) {
            $this->currentStep = $step;
        }
    }

    public function submit(GeneralSettings $settings): void
    {
        $this->validate($this->rulesForStep(5));

        // Check if PPDB is open
        if (!$settings->ppdb_is_active) {
            session()->flash('error', 'Pendaftaran PPDB saat ini sedang ditutup.');
            return;
        }

        // Store files if uploaded
        $photoPath = $this->file_photo ? $this->file_photo->store('ppdb/photos', 'public') : null;
        $kkPath = $this->file_kk ? $this->file_kk->store('ppdb/kk', 'public') : null;
        $aktaPath = $this->file_birth_certificate ? $this->file_birth_certificate->store('ppdb/akta', 'public') : null;
        $berkasPath = $this->file_report_or_diploma ? $this->file_report_or_diploma->store('ppdb/berkas', 'public') : null;

        $registration = PpdbRegistration::create([
            'academic_year' => $settings->ppdb_academic_year ?? date('Y') . '/' . (date('Y') + 1),
            'full_name' => $this->full_name,
            'nisn' => $this->nisn,
            'nik' => $this->nik,
            'gender' => $this->gender,
            'birth_place' => $this->birth_place,
            'birth_date' => $this->birth_date,
            'religion' => $this->religion,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'father_name' => $this->father_name,
            'father_occupation' => $this->father_occupation,
            'mother_name' => $this->mother_name,
            'mother_occupation' => $this->mother_occupation,
            'parent_income' => $this->parent_income,
            'parent_phone' => $this->parent_phone,
            'previous_school_name' => $this->previous_school_name,
            'previous_school_address' => $this->previous_school_address,
            'average_score' => $this->average_score ? (float) $this->average_score : null,
            'chosen_major' => $this->chosen_major,
            'file_photo' => $photoPath,
            'file_kk' => $kkPath,
            'file_birth_certificate' => $aktaPath,
            'file_report_or_diploma' => $berkasPath,
            'status' => 'pending',
        ]);

        $this->registeredData = $registration;
        $this->registrationNumber = $registration->registration_number;
        $this->isSubmitted = true;
    }

    public function render(GeneralSettings $settings)
    {
        return view('livewire.ppdb-registration-form', [
            'settings' => $settings,
        ]);
    }
}

