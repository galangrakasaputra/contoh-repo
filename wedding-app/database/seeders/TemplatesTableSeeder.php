<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplatesTableSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $templates = [
            [
                'name' => 'Elegance Rose & Gold',
                'slug' => 'elegance-rose-gold',
                'category' => 'Luxury / Premium',
                'price' => 149000,
                'description' => 'Elegan dengan nuansa mawar dan aksen emas.',
                'thumbnail' => null,
                'demo_url' => null,
                'background' => null,
                'features' => ['Musik Background', 'RSVP & Ucapan', 'Amplop Digital'],
                'is_active' => true,
                'sort_order' => 10,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'name' => 'Botanical Greenery',
                'slug' => 'botanical-greenery',
                'category' => 'Floral & Nature',
                'price' => 129000,
                'description' => 'Tema hijau dengan elemen botani yang menenangkan.',
                'thumbnail' => null,
                'demo_url' => null,
                'background' => null,
                'features' => ['Galeri Foto', 'Peta Lokasi Google', 'Count Down Time'],
                'is_active' => true,
                'sort_order' => 20,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'name' => 'Javanese Heritage Traditional',
                'slug' => 'javanese-heritage-traditional',
                'category' => 'Tema Adat',
                'price' => 149000,
                'description' => 'Mengangkat kekayaan budaya Jawa dengan ornamen tradisional.',
                'thumbnail' => null,
                'demo_url' => null,
                'background' => null,
                'features' => ['Ornamen Adat', 'Buku Tamu Digital', 'Musik Musik Daerah'],
                'is_active' => true,
                'sort_order' => 30,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'name' => 'Minimalist Aesthetic White',
                'slug' => 'minimalist-aesthetic-white',
                'category' => 'Modern Minimalis',
                'price' => 99000,
                'description' => 'Desain minimalis yang bersih dan elegan.',
                'thumbnail' => null,
                'demo_url' => null,
                'background' => null,
                'features' => ['Ringan & Cepat', 'Mendukung Video', 'RSVP WhatsApp'],
                'is_active' => true,
                'sort_order' => 40,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($templates as $data) {
            // ensure features stored as JSON array
            $data['features'] = json_encode($data['features']);

            Template::unguard();
            \DB::table('templates')->updateOrInsert(
                ['slug' => $data['slug']],
                $data
            );
            Template::reguard();
        }
    }
}
