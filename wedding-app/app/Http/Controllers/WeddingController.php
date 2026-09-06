<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class WeddingController extends Controller
{
    /**
     * Menampilkan form pembuatan undangan.
     */
    public function create(Request $request)
    {
        $templateId = $request->integer('template');

        $template = Template::query()
            ->where('id', $templateId)
            ->where('is_active', true)
            ->firstOrFail();

        return view('weddings.create', compact('template'));
    }

    /**
     * Menyimpan data utama undangan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            /*
            |--------------------------------------------------------------------------
            | TEMPLATE
            |--------------------------------------------------------------------------
            */
            'template_id' => [
                'nullable',
                'integer',
            ],

            /*
            |--------------------------------------------------------------------------
            | MEMPELAI PRIA
            |--------------------------------------------------------------------------
            */
            'groom_name' => [
                'required',
                'string',
                'max:255',
            ],

            'groom_nickname' => [
                'nullable',
                'string',
                'max:100',
            ],

            /*
            |--------------------------------------------------------------------------
            | MEMPELAI WANITA
            |--------------------------------------------------------------------------
            */
            'bride_name' => [
                'required',
                'string',
                'max:255',
            ],

            'bride_nickname' => [
                'nullable',
                'string',
                'max:100',
            ],

            'groom_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'bride_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],

            /*
            |--------------------------------------------------------------------------
            | ORANG TUA
            |--------------------------------------------------------------------------
            */
            'groom_father' => [
                'nullable',
                'string',
                'max:255',
            ],

            'groom_mother' => [
                'nullable',
                'string',
                'max:255',
            ],

            'bride_father' => [
                'nullable',
                'string',
                'max:255',
            ],

            'bride_mother' => [
                'nullable',
                'string',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | PESAN
            |--------------------------------------------------------------------------
            */
            'message' => [
                'nullable',
                'string',
            ],

            'music' => ['nullable', 'file', 'mimes:mp3,mpeg', 'max:10240'],

            'gallery' => ['nullable', 'array', 'max:20'],
            'gallery.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],

            /*
            |--------------------------------------------------------------------------
            | AKAD (optional)
            |--------------------------------------------------------------------------
            */
            'akad_date' => ['nullable', 'date'],
            'akad_start_time' => ['nullable', 'date_format:H:i'],
            'akad_end_time' => ['nullable', 'date_format:H:i'],
            'akad_address' => ['nullable', 'string'],
            'akad_maps_url' => ['nullable', 'url'],

            /*
            |--------------------------------------------------------------------------
            | RECEPTION (optional)
            |--------------------------------------------------------------------------
            */
            'reception_date' => ['nullable', 'date'],
            'reception_start_time' => ['nullable', 'date_format:H:i'],
            'reception_end_time' => ['nullable', 'date_format:H:i'],
            'reception_address' => ['nullable', 'string'],
            'reception_maps_url' => ['nullable', 'url'],

            /*
            |--------------------------------------------------------------------------
            | PAYMENT
            |--------------------------------------------------------------------------
            */
            'bank_name' => ['nullable', 'string', 'max:150'],
            'account_number' => ['nullable', 'string', 'max:64'],
            'account_name' => ['nullable', 'string', 'max:150'],
            'account_number_alt' => ['nullable', 'string', 'max:64'],
            'account_name_alt' => ['nullable', 'string', 'max:150'],

            'groom_bank_name' => ['nullable', 'string', 'max:150'],
            'groom_account_number' => ['nullable', 'string', 'max:64'],
            'groom_account_name' => ['nullable', 'string', 'max:150'],
            'bride_bank_name' => ['nullable', 'string', 'max:150'],
            'bride_account_number' => ['nullable', 'string', 'max:64'],
            'bride_account_name' => ['nullable', 'string', 'max:150'],

            /*
            |--------------------------------------------------------------------------
            | BACKGROUND
            |--------------------------------------------------------------------------
            */
            'background_type' => [
                'required',
                Rule::in([
                    'default',
                    'custom',
                ]),
            ],

            'custom_background' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120', // maksimal 5 MB
            ],
        ], [
            /*
            |--------------------------------------------------------------------------
            | ERROR MESSAGE
            |--------------------------------------------------------------------------
            */
            // template_id validation is temporarily relaxed; keep message minimal

            'groom_name.required' => 'Nama mempelai pria wajib diisi.',
            'groom_name.max' => 'Nama mempelai pria maksimal 255 karakter.',

            'groom_nickname.max' => 'Nama panggilan mempelai pria maksimal 100 karakter.',

            'bride_name.required' => 'Nama mempelai wanita wajib diisi.',
            'bride_name.max' => 'Nama mempelai wanita maksimal 255 karakter.',

            'bride_nickname.max' => 'Nama panggilan mempelai wanita maksimal 100 karakter.',

            'groom_father.max' => 'Nama ayah mempelai pria maksimal 255 karakter.',
            'groom_mother.max' => 'Nama ibu mempelai pria maksimal 255 karakter.',

            'bride_father.max' => 'Nama ayah mempelai wanita maksimal 255 karakter.',
            'bride_mother.max' => 'Nama ibu mempelai wanita maksimal 255 karakter.',

            'background_type.required' => 'Background wajib dipilih.',
            'background_type.in' => 'Jenis background tidak valid.',

            'custom_background.image' => 'Background harus berupa file gambar.',
            'custom_background.mimes' => 'Background hanya boleh JPG, JPEG, PNG, atau WEBP.',
            'custom_background.max' => 'Ukuran background maksimal 5 MB.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | USER LOGIN
        |--------------------------------------------------------------------------
        */
        $user = Auth::user();

        if (! $user) {
            return redirect()
                ->route('home')
                ->withErrors([
                    'wedding' => 'Anda harus login terlebih dahulu.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | PASTIKAN TEMPLATE MASIH AKTIF (sementara: tidak wajib)
        | Jika template tidak ditemukan atau tidak aktif, simpan `template_id` sebagai null
        | agar data undangan tetap bisa disimpan sementara.
        |--------------------------------------------------------------------------
        */
        $template = null;
        if (! empty($validated['template_id'])) {
            $template = Template::query()
                ->where('id', $validated['template_id'])
                ->where('is_active', true)
                ->first();
        }

        /*
        |--------------------------------------------------------------------------
        | BACKGROUND
        |--------------------------------------------------------------------------
        */
        $backgroundValue = null;
        $uploadedBackground = null;
        $musicValue = null;
        $galleryValues = [];
        $uploadedFiles = [];
        $groomPhotoValue = null;
        $bridePhotoValue = null;

        try {

            /*
            |--------------------------------------------------------------------------
            | Kalau menggunakan background custom
            |--------------------------------------------------------------------------
            */
            if (
                $validated['background_type'] === 'custom'
                && $request->hasFile('custom_background')
            ) {
                $uploadedBackground = $request->file('custom_background');

                $backgroundValue = $uploadedBackground->store(
                    'weddings/backgrounds',
                    'public'
                );

                $uploadedFiles[] = $backgroundValue;
            }

            if ($request->hasFile('music')) {
                $musicValue = $request->file('music')->store(
                    'weddings/music',
                    'public'
                );

                $uploadedFiles[] = $musicValue;
            }

            foreach ($request->file('gallery', []) as $galleryImage) {
                $galleryValue = $galleryImage->store(
                    'weddings/gallery',
                    'public'
                );

                $galleryValues[] = $galleryValue;
                $uploadedFiles[] = $galleryValue;
            }

            foreach (['groom_photo', 'bride_photo'] as $photoField) {
                if ($request->hasFile($photoField)) {
                    $photoValue = $request->file($photoField)->store(
                        'weddings/couple',
                        'public'
                    );

                    $uploadedFiles[] = $photoValue;

                    if ($photoField === 'groom_photo') {
                        $groomPhotoValue = $photoValue;
                    } else {
                        $bridePhotoValue = $photoValue;
                    }
                }
            }

            /*
            |--------------------------------------------------------------------------
            | TRANSACTION DATABASE
            |--------------------------------------------------------------------------
            */
            DB::beginTransaction();

            $wedding = Wedding::create([
                'user_id' => $user->id,

                'template_id' => $template ? $template->id : null,

                'data' => $this->buildWeddingData(
                    array_merge($validated, [
                        'template_id' => $template ? $template->id : null,
                        'music' => $musicValue,
                        'groom_photo' => $groomPhotoValue,
                        'bride_photo' => $bridePhotoValue,
                    ]),
                    $backgroundValue,
                    $galleryValues
                ),

                'groom_name' => $validated['groom_name'],
                'groom_nickname' => $validated['groom_nickname'] ?? null,

                'bride_name' => $validated['bride_name'],
                'bride_nickname' => $validated['bride_nickname'] ?? null,

                'groom_father' => $validated['groom_father'] ?? null,
                'groom_mother' => $validated['groom_mother'] ?? null,

                'bride_father' => $validated['bride_father'] ?? null,
                'bride_mother' => $validated['bride_mother'] ?? null,

                'message' => $validated['message'] ?? null,

                // acara
                'akad_date' => $validated['akad_date'] ?? null,
                'akad_start_time' => $validated['akad_start_time'] ?? null,
                'akad_end_time' => $validated['akad_end_time'] ?? null,
                'akad_address' => $validated['akad_address'] ?? null,
                'akad_maps_url' => $validated['akad_maps_url'] ?? null,

                'reception_date' => $validated['reception_date'] ?? null,
                'reception_start_time' => $validated['reception_start_time'] ?? null,
                'reception_end_time' => $validated['reception_end_time'] ?? null,
                'reception_address' => $validated['reception_address'] ?? null,
                'reception_maps_url' => $validated['reception_maps_url'] ?? null,

                // pembayaran
                'bank_name' => $validated['bank_name'] ?? null,
                'account_number' => $validated['account_number'] ?? null,
                'account_name' => $validated['account_name'] ?? null,
                'account_number_alt' => $validated['account_number_alt'] ?? null,
                'account_name_alt' => $validated['account_name_alt'] ?? null,

                'background_type' => $validated['background_type'],

                'background_value' => $backgroundValue,

                'status' => 'draft',
            ]);

            DB::commit();

            /*
            |--------------------------------------------------------------------------
            | REDIRECT
            |--------------------------------------------------------------------------
            */
            return redirect()
                ->route('weddings.edit', $wedding->id)
                ->with(
                    'success',
                    'Data undangan berhasil disimpan sebagai draft.'
                );

        } catch (\Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | ROLLBACK DATABASE
            |--------------------------------------------------------------------------
            */
            DB::rollBack();

            /*
            |--------------------------------------------------------------------------
            | HAPUS FILE JIKA DATABASE GAGAL
            |--------------------------------------------------------------------------
            */
            foreach ($uploadedFiles as $uploadedFile) {
                Storage::disk('public')->delete($uploadedFile);
            }

            /*
            |--------------------------------------------------------------------------
            | LOG ERROR
            |--------------------------------------------------------------------------
            */
            report($e);

            return back()
                ->withInput()
                ->withErrors([
                    'wedding' => 'Gagal menyimpan data undangan. Silakan coba lagi.',
                ]);
        }
    }

    /**
     * Menampilkan halaman edit undangan.
     */
    public function edit(Wedding $wedding)
    {
        abort_unless(
            $wedding->user_id === Auth::id(),
            403
        );

        $wedding->load('template');

        return view(
            'weddings.edit',
            compact('wedding')
        );
    }

    /**
     * List user's weddings.
     */
    public function index()
    {
        $user = Auth::user();

        $weddings = Wedding::query()
            ->with('template')
            ->where('user_id', $user->id)
            ->orderByDesc('id')
            ->get();

        return view('weddings.index', compact('weddings'));
    }

    /**
     * Show a wedding preview for the owner.
     */
    public function show(Wedding $wedding)
    {
        $wedding->load(['template', 'rsvps' => fn ($query) => $query->latest()]);

        // If a demo view exists for the selected template, render it standalone
        if ($wedding->template && view()->exists('templates.demos.'.$wedding->template->slug)) {
            return view('templates.demos.'.$wedding->template->slug, compact('wedding'));
        }

        return view('weddings.show', compact('wedding'));
    }

    /**
     * Update data utama undangan.
     */
    public function update(Request $request, Wedding $wedding)
    {
        abort_unless(
            $wedding->user_id === Auth::id(),
            403
        );

        $validated = $request->validate([
            'template_id' => [
                'required',
                'integer',
                Rule::exists('templates', 'id')
                    ->where(
                        fn ($query) => $query->where('is_active', true)
                    ),
            ],

            'groom_name' => [
                'required',
                'string',
                'max:255',
            ],

            'groom_nickname' => [
                'nullable',
                'string',
                'max:100',
            ],

            'bride_name' => [
                'required',
                'string',
                'max:255',
            ],

            'bride_nickname' => [
                'nullable',
                'string',
                'max:100',
            ],

            'groom_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'bride_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],

            'groom_father' => [
                'nullable',
                'string',
                'max:255',
            ],

            'groom_mother' => [
                'nullable',
                'string',
                'max:255',
            ],

            'bride_father' => [
                'nullable',
                'string',
                'max:255',
            ],

            'bride_mother' => [
                'nullable',
                'string',
                'max:255',
            ],

            'message' => [
                'nullable',
                'string',
            ],

            'music' => ['nullable', 'file', 'mimes:mp3,mpeg', 'max:10240'],

            'gallery' => ['nullable', 'array', 'max:20'],
            'gallery.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],

            'groom_bank_name' => ['nullable', 'string', 'max:150'],
            'groom_account_number' => ['nullable', 'string', 'max:64'],
            'groom_account_name' => ['nullable', 'string', 'max:150'],
            'bride_bank_name' => ['nullable', 'string', 'max:150'],
            'bride_account_number' => ['nullable', 'string', 'max:64'],
            'bride_account_name' => ['nullable', 'string', 'max:150'],

            'background_type' => [
                'required',
                Rule::in([
                    'default',
                    'custom',
                ]),
            ],

            'custom_background' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ]);

        $backgroundValue = $wedding->background_value;
        $musicValue = data_get($wedding->data, 'music');
        $galleryValues = data_get($wedding->data, 'gallery', []);
        $groomPhotoValue = data_get($wedding->data, 'groom.photo');
        $bridePhotoValue = data_get($wedding->data, 'bride.photo');

        /*
        |--------------------------------------------------------------------------
        | Upload background baru
        |--------------------------------------------------------------------------
        */
        if (
            $validated['background_type'] === 'custom'
            && $request->hasFile('custom_background')
        ) {
            $newBackground = $request->file('custom_background')->store(
                'weddings/backgrounds',
                'public'
            );

            // Hapus file lama
            if ($wedding->background_value) {
                Storage::disk('public')->delete(
                    $wedding->background_value
                );
            }

            $backgroundValue = $newBackground;
        }

        if ($request->hasFile('music')) {
            if ($musicValue) {
                Storage::disk('public')->delete($musicValue);
            }

            $musicValue = $request->file('music')->store(
                'weddings/music',
                'public'
            );
        }

        foreach ($request->file('gallery', []) as $galleryImage) {
            $galleryValues[] = $galleryImage->store(
                'weddings/gallery',
                'public'
            );
        }

        foreach (['groom_photo', 'bride_photo'] as $photoField) {
            if ($request->hasFile($photoField)) {
                $oldPhotoValue = $photoField === 'groom_photo'
                    ? $groomPhotoValue
                    : $bridePhotoValue;

                if ($oldPhotoValue) {
                    Storage::disk('public')->delete($oldPhotoValue);
                }

                $photoValue = $request->file($photoField)->store(
                    'weddings/couple',
                    'public'
                );

                if ($photoField === 'groom_photo') {
                    $groomPhotoValue = $photoValue;
                } else {
                    $bridePhotoValue = $photoValue;
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Kalau kembali ke default
        |--------------------------------------------------------------------------
        */
        if ($validated['background_type'] === 'default') {

            if ($wedding->background_value) {
                Storage::disk('public')->delete(
                    $wedding->background_value
                );
            }

            $backgroundValue = null;
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */
        $wedding->update([
            'template_id' => $validated['template_id'],

            'data' => $this->buildWeddingData(
                array_merge(
                    $wedding->only([
                        'template_id',
                        'groom_name',
                        'groom_nickname',
                        'bride_name',
                        'bride_nickname',
                        'groom_father',
                        'groom_mother',
                        'bride_father',
                        'bride_mother',
                        'message',
                        'akad_date',
                        'akad_start_time',
                        'akad_end_time',
                        'akad_address',
                        'akad_maps_url',
                        'reception_date',
                        'reception_start_time',
                        'reception_end_time',
                        'reception_address',
                        'reception_maps_url',
                        'bank_name',
                        'account_number',
                        'account_name',
                        'account_number_alt',
                        'account_name_alt',
                    ]),
                    $validated,
                    [
                        'background_type' => $validated['background_type'],
                        'music' => $musicValue,
                        'groom_photo' => $groomPhotoValue,
                        'bride_photo' => $bridePhotoValue,
                    ]
                ),
                $backgroundValue,
                $galleryValues
            ),

            'groom_name' => $validated['groom_name'],
            'groom_nickname' => $validated['groom_nickname'] ?? null,

            'bride_name' => $validated['bride_name'],
            'bride_nickname' => $validated['bride_nickname'] ?? null,

            'groom_father' => $validated['groom_father'] ?? null,
            'groom_mother' => $validated['groom_mother'] ?? null,

            'bride_father' => $validated['bride_father'] ?? null,
            'bride_mother' => $validated['bride_mother'] ?? null,

            'message' => $validated['message'] ?? null,

            'background_type' => $validated['background_type'],
            'background_value' => $backgroundValue,
        ]);

        return back()->with(
            'success',
            'Data undangan berhasil diperbarui.'
        );
    }

    private function buildWeddingData(
        array $values,
        ?string $backgroundValue,
        array $galleryValues = []
    ): array {
        return [
            'template_id' => $values['template_id'] ?? null,
            'groom' => [
                'name' => $values['groom_name'] ?? null,
                'nickname' => $values['groom_nickname'] ?? null,
                'father' => $values['groom_father'] ?? null,
                'mother' => $values['groom_mother'] ?? null,
                'photo' => $values['groom_photo'] ?? null,
            ],
            'bride' => [
                'name' => $values['bride_name'] ?? null,
                'nickname' => $values['bride_nickname'] ?? null,
                'father' => $values['bride_father'] ?? null,
                'mother' => $values['bride_mother'] ?? null,
                'photo' => $values['bride_photo'] ?? null,
            ],
            'events' => [
                'akad' => [
                    'date' => $values['akad_date'] ?? null,
                    'start_time' => $values['akad_start_time'] ?? null,
                    'end_time' => $values['akad_end_time'] ?? null,
                    'address' => $values['akad_address'] ?? null,
                    'maps_url' => $values['akad_maps_url'] ?? null,
                ],
                'reception' => [
                    'date' => $values['reception_date'] ?? null,
                    'start_time' => $values['reception_start_time'] ?? null,
                    'end_time' => $values['reception_end_time'] ?? null,
                    'address' => $values['reception_address'] ?? null,
                    'maps_url' => $values['reception_maps_url'] ?? null,
                ],
            ],
            'message' => $values['message'] ?? null,
            'payment' => [
                'groom' => [
                    'bank_name' => $values['groom_bank_name'] ?? $values['bank_name'] ?? null,
                    'account_number' => $values['groom_account_number'] ?? $values['account_number'] ?? null,
                    'account_name' => $values['groom_account_name'] ?? $values['account_name'] ?? null,
                ],
                'bride' => [
                    'bank_name' => $values['bride_bank_name'] ?? $values['bank_name'] ?? null,
                    'account_number' => $values['bride_account_number'] ?? $values['account_number_alt'] ?? null,
                    'account_name' => $values['bride_account_name'] ?? $values['account_name_alt'] ?? null,
                ],
                'bank_name' => $values['bank_name'] ?? null,
                'account_number' => $values['account_number'] ?? null,
                'account_name' => $values['account_name'] ?? null,
                'account_number_alt' => $values['account_number_alt'] ?? null,
                'account_name_alt' => $values['account_name_alt'] ?? null,
            ],
            'background' => [
                'type' => $values['background_type'] ?? 'default',
                'value' => $backgroundValue,
            ],
            'music' => $values['music'] ?? null,
            'gallery' => $galleryValues,
        ];
    }
}
