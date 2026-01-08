<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Kuliner',
                'description' => 'Usaha yang bergerak di bidang makanan dan minuman, baik olahan rumahan maupun produk siap saji.'
            ],
            [
                'name' => 'Fashion',
                'description' => 'Produk pakaian dan penunjang penampilan seperti busana, hijab, tas, sepatu, dan aksesoris.'
            ],
            [
                'name' => 'Kerajinan',
                'description' => 'Produk kreatif berbasis keterampilan tangan dan nilai seni khas daerah.'
            ],
            [
                'name' => 'Jasa',
                'description' => 'Usaha yang menyediakan layanan atau keahlian tanpa menghasilkan produk fisik.'
            ],
            [
                'name' => 'Pertanian & Perikanan',
                'description' => 'Usaha hasil alam, budidaya, serta pengolahan produk pertanian dan perikanan.'
            ],
            [
                'name' => 'Kecantikan & Kesehatan',
                'description' => 'Produk perawatan tubuh, kecantikan, dan kesehatan termasuk kosmetik dan herbal.'
            ],
            [
                'name' => 'Rumah Tangga',
                'description' => 'Produk kebutuhan rumah tangga seperti peralatan dapur, dekorasi, dan perlengkapan rumah.'
            ],
            [
                'name' => 'Lainnya',
                'description' => 'Kategori tambahan untuk produk UMKM yang belum termasuk kategori utama.'
            ],
        ]);
    }
}
