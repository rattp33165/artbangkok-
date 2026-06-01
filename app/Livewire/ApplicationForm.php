<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class ApplicationForm extends Component
{
    use WithFileUploads;

    public $application;

    // Gallery Information
    public $gallery_type = '';
    public $gallery_name = '';
    public $year_founded = '';
    public $description = '';
    public $website_url = '';
    public $gallery_email = '';
    public $phone = '';
    public $instagram = '';
    public $facebook = '';

    // Business Registration
    public $business_name = '';
    public $business_license = '';

    // Head Office
    public $office_country = '';
    public $office_city = '';
    public $office_zipcode = '';
    public $office_address = '';
    public $director_name = '';
    public $director_phone = '';
    public $director_email = '';

    // Branches
    public $branches = [
        ['name' => '', 'country' => '', 'city' => ''],
        ['name' => '', 'country' => '', 'city' => ''],
        ['name' => '', 'country' => '', 'city' => ''],
    ];

    // Represented Artists
    public $represented_artists = ['', '', ''];

    // Booth
    public $booth_section = '';
    public $booth_type = '';

    // Participating Artists
    public $participating_artists = [
        ['name' => '', 'year_of_birth' => '', 'nationality' => '', 'introduction' => ''],
        ['name' => '', 'year_of_birth' => '', 'nationality' => '', 'introduction' => ''],
        ['name' => '', 'year_of_birth' => '', 'nationality' => '', 'introduction' => ''],
    ];

    // Person in Charge
    public $persons_in_charge = [
        ['name' => '', 'position' => 'Curator', 'email' => '', 'phone' => ''],
        ['name' => '', 'position' => 'Gallery Manager', 'email' => '', 'phone' => ''],
    ];

    // Exhibitions
    public $exhibitions = [
        ['title' => '', 'date_start' => '', 'date_end' => '', 'introduction' => ''],
        ['title' => '', 'date_start' => '', 'date_end' => '', 'introduction' => ''],
    ];

    // Art Fairs
    public $art_fairs = [
        ['name' => '', 'year' => ''],
        ['name' => '', 'year' => ''],
        ['name' => '', 'year' => ''],
        ['name' => '', 'year' => ''],
        ['name' => '', 'year' => ''],
    ];

    public function mount()
    {
        $this->application = Application::firstOrCreate(
            ['user_id' => Auth::id()],
            ['status' => 'draft']
        );
        $this->loadData();
    }

    public function loadData()
    {
        $app = $this->application;
        $this->gallery_type    = $app->gallery_type ?? '';
        $this->gallery_name    = $app->gallery_name ?? '';
        $this->year_founded    = $app->year_founded ?? '';
        $this->description     = $app->description ?? '';
        $this->website_url     = $app->website_url ?? '';
        $this->gallery_email   = $app->gallery_email ?? '';
        $this->phone           = $app->phone ?? '';
        $this->instagram       = $app->instagram ?? '';
        $this->facebook        = $app->facebook ?? '';
        $this->business_name   = $app->business_name ?? '';
        $this->business_license = $app->business_license ?? '';
        $this->office_country  = $app->office_country ?? '';
        $this->office_city     = $app->office_city ?? '';
        $this->office_zipcode  = $app->office_zipcode ?? '';
        $this->office_address  = $app->office_address ?? '';
        $this->director_name   = $app->director_name ?? '';
        $this->director_phone  = $app->director_phone ?? '';
        $this->director_email  = $app->director_email ?? '';
        $this->booth_section   = $app->booth_section ?? '';
        $this->booth_type      = $app->booth_type ?? '';

        if ($app->branches)          $this->branches = $app->branches;
        if ($app->represented_artists) $this->represented_artists = $app->represented_artists;
        if ($app->persons_in_charge) $this->persons_in_charge = $app->persons_in_charge;
        if ($app->art_fairs)         $this->art_fairs = $app->art_fairs;
    }

    public function saveGalleryInfo()
    {
        $this->validate([
            'gallery_type'  => 'nullable|in:international,thai',
            'gallery_name'  => 'nullable|string|max:255',
            'year_founded'  => 'nullable|integer|min:1800|max:' . date('Y'),
            'description'   => 'nullable|string|max:1000',
            'website_url'   => 'nullable|url',
            'gallery_email' => 'nullable|email',
            'phone'         => 'nullable|string|max:50',
            'instagram'     => 'nullable|string|max:255',
            'facebook'      => 'nullable|string|max:255',
        ]);

        $this->application->update([
            'gallery_type'  => $this->gallery_type ?: null,
            'gallery_name'  => $this->gallery_name ?: null,
            'year_founded'  => $this->year_founded ?: null,
            'description'   => $this->description ?: null,
            'website_url'   => $this->website_url ?: null,
            'gallery_email' => $this->gallery_email ?: null,
            'phone'         => $this->phone ?: null,
            'instagram'     => $this->instagram ?: null,
            'facebook'      => $this->facebook ?: null,
        ]);
        $this->updateProgress();
        session()->flash('saved_gallery', 'Saved!');
    }

    public function saveBusinessInfo()
    {
        $this->validate([
            'business_name'    => 'nullable|string|max:255',
            'business_license' => 'nullable|string|max:100',
        ]);

        $this->application->update([
            'business_name'    => $this->business_name ?: null,
            'business_license' => $this->business_license ?: null,
        ]);
        $this->updateProgress();
        session()->flash('saved_business', 'Saved!');
    }

    public function saveHeadOffice()
    {
        $this->validate([
            'office_country'  => 'nullable|string|max:100',
            'office_city'     => 'nullable|string|max:100',
            'office_zipcode'  => 'nullable|string|max:20',
            'office_address'  => 'nullable|string|max:500',
            'director_name'   => 'nullable|string|max:255',
            'director_phone'  => 'nullable|string|max:50',
            'director_email'  => 'nullable|email',
        ]);

        $this->application->update([
            'office_country'  => $this->office_country ?: null,
            'office_city'     => $this->office_city ?: null,
            'office_zipcode'  => $this->office_zipcode ?: null,
            'office_address'  => $this->office_address ?: null,
            'director_name'   => $this->director_name ?: null,
            'director_phone'  => $this->director_phone ?: null,
            'director_email'  => $this->director_email ?: null,
        ]);
        $this->updateProgress();
        session()->flash('saved_office', 'Saved!');
    }

    public function saveBranches()
    {
        $this->application->update([
            'branches' => collect($this->branches)->map(fn($b) => [
                'name'    => $b['name'] ?? '',
                'country' => $b['country'] ?? '',
                'city'    => $b['city'] ?? '',
            ])->toArray(),
        ]);
        $this->updateProgress();
        session()->flash('saved_branches', 'Saved!');
    }

    public function saveRepresentedArtists()
    {
        $this->application->update([
            'represented_artists' => array_values(array_filter($this->represented_artists)),
        ]);
        $this->updateProgress();
        session()->flash('saved_artists', 'Saved!');
    }

    public function saveBooth()
    {
        $this->validate([
            'booth_section' => 'nullable|in:gallery,other',
            'booth_type'    => 'nullable|in:A,B',
        ]);

        $this->application->update([
            'booth_section' => $this->booth_section ?: null,
            'booth_type'    => $this->booth_type ?: null,
        ]);
        $this->updateProgress();
        session()->flash('saved_booth', 'Saved!');
    }

    public function savePersonsInCharge()
    {
        $this->application->update([
            'persons_in_charge' => collect($this->persons_in_charge)->map(fn($p) => [
                'name'     => $p['name'] ?? '',
                'position' => $p['position'] ?? '',
                'email'    => $p['email'] ?? '',
                'phone'    => $p['phone'] ?? '',
            ])->toArray(),
        ]);
        $this->updateProgress();
        session()->flash('saved_persons', 'Saved!');
    }

    public function saveArtFairs()
    {
        $this->application->update([
            'art_fairs' => collect($this->art_fairs)
                ->filter(fn($f) => !empty($f['name']))
                ->map(fn($f) => [
                    'name' => $f['name'] ?? '',
                    'year' => $f['year'] ?? '',
                ])->values()->toArray(),
        ]);
        $this->updateProgress();
        session()->flash('saved_fairs', 'Saved!');
    }

    public function updateProgress()
    {
        $app = $this->application->fresh();
        $sections = [
            (bool)$app->gallery_name,
            (bool)$app->business_name,
            (bool)$app->office_country,
            (bool)($app->branches && collect($app->branches)->first()['name'] ?? false),
            (bool)$app->booth_section,
            (bool)($app->represented_artists && $app->represented_artists[0] ?? false),
            (bool)($app->persons_in_charge && collect($app->persons_in_charge)->first()['name'] ?? false),
            (bool)$app->art_fairs,
        ];
        $percent = (int)(collect($sections)->filter()->count() / count($sections) * 100);
        $app->update(['completion_percent' => $percent]);
        $this->application = $app;
    }

    public function render()
    {
        return view('livewire.application-form');
    }
}
