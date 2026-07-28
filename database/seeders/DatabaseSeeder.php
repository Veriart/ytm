<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin & Customer Users
        User::create([
            'name' => 'Administrator YTM',
            'email' => 'admin@ytm.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '0811-1222-3333',
            'address' => 'PT Yakin Tri Medika Office, Jakarta',
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'user@ytm.com',
            'password' => Hash::make('user123'),
            'role' => 'customer',
            'phone' => '0812-3456-7890',
            'address' => "Jl. Gajah Mada No. 123, Komplek Medika Permai, Kec. Gambir, Jakarta Pusat, DKI Jakarta 10130",
        ]);

        // 2. Create Categories
        $cats = Category::create(['name' => 'Cats & Dogs', 'slug' => 'cats']);
        $livestock = Category::create(['name' => 'Livestock', 'slug' => 'livestock']);
        $poultry = Category::create(['name' => 'Poultry', 'slug' => 'poultry']);
        $birds = Category::create(['name' => 'Birds', 'slug' => 'birds']);
        $aqua = Category::create(['name' => 'Aqua', 'slug' => 'aqua']);

        // 3. Create Products
        Product::create([
            'category_id' => $cats->id,
            'name' => 'NexGard Spectra L (30-60kg) Dog Parasite Treatment',
            'slug' => Str::slug('NexGard Spectra L (30-60kg) Dog Parasite Treatment'),
            'description' => 'NexGard Spectra L provides complete protection against fleas, ticks, mites, heartworm, and intestinal worms in large dogs (30-60kg). Clean veterinary chewable tablets that are easy to administer.',
            'price' => 485000,
            'stock' => 50,
            'image' => '/img/product/oralade.webp', // local mockup fallback or default image
            'rating' => 4.90,
            'sold_count' => 2200,
            'dosage_guidelines' => 'Give 1 chewable tablet monthly according to dog weight.',
            'indication' => 'Prevents flea & tick infestation, treats lungworm and roundworms.',
            'pharmacist_note' => 'Keep out of reach of children. Store in a dry place under 30°C.',
        ]);

        Product::create([
            'category_id' => $cats->id,
            'name' => 'Vetoquinol Laxatone Cat Digestive Health 120g',
            'slug' => Str::slug('Vetoquinol Laxatone Cat Digestive Health 120g'),
            'description' => 'Vetoquinol Laxatone is a premium lubricant gel for hairball prevention and elimination in cats. Formulated with a highly palatable tuna taste.',
            'price' => 125000,
            'stock' => 100,
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCiRKO8ARPsKgS00nWiiCL8p1_04_1Y7RKc1Z_NR7At3op_MOgkGZajrxu0ERA51clh9SMWzll6zPhA5i1lVN_19L9I0ISBVQWaujDxRAHD8MZ6jzWtQOR4DDkBODa6lfPr5pYXXrwrvKWNHzT7I3rw32TKzfABvIvuL9MsJT1HVAPknasFtB_WP46qr7qWVLqWnbAReBiP4Vp3B2_ok7-YO1p7tBs8jKPY01bLmaPcAHtkjzUxQdwbBQ',
            'rating' => 5.00,
            'sold_count' => 500,
            'dosage_guidelines' => "Place a small amount on cat's nose or paws to stimulate taste interest. Administer 1/2 to 1 teaspoon daily.",
            'indication' => 'Eliminates hairball-related digestive obstructions and constipation.',
            'pharmacist_note' => 'Suitable for cats over 6 months of age.',
        ]);

        Product::create([
            'category_id' => $livestock->id,
            'name' => 'Penstrep-400 Livestock Injectable Solution 100ml',
            'slug' => Str::slug('Penstrep-400 Livestock Injectable Solution 100ml'),
            'description' => 'Penstrep-400 is a broad-spectrum antibiotic injection for cattle, horses, sheep, and swine. Contains Procaine Penicillin G and Dihydrostreptomycin.',
            'price' => 210000,
            'stock' => 30,
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA9rCsuxfj37HDrp4pTaI6Fz4YYG4ASsItscR6e_zJiyBcI2JD2CiDQUWZTQzLTinMn3BYhmcoXiXCSOGfEshzohL7o8YMmwCwd4UbbutPvyrFLpw27Yl7InyF78PBKN0644XdgTG_PbnKqWWQeJwlwE2nPTVbGzZyqtr7EiC3NyRvlLSf4EamMozh1EJ7DEateKIDWlqtkSysXCLq3MpaCTDHpqP0UL3XzCwm2F_x2VKtJRE-5doh6kg',
            'rating' => 4.80,
            'sold_count' => 150,
            'dosage_guidelines' => '1 ml per 25 kg bodyweight daily by deep intramuscular injection for 3-5 days.',
            'indication' => 'Treatment of respiratory, urinary, and gastrointestinal tract infections caused by penicillin and streptomycin sensitive microorganisms.',
            'pharmacist_note' => 'Withdrawal time: Meat 28 days, Milk 3 days.',
        ]);

        Product::create([
            'category_id' => $birds->id,
            'name' => 'Multi-Vite Bird Liquid Supplement 30ml',
            'slug' => Str::slug('Multi-Vite Bird Liquid Supplement 30ml'),
            'description' => 'Multi-Vite provides essential vitamins and minerals to support feather quality, singing performance, and immune health in pet birds.',
            'price' => 65000,
            'stock' => 150,
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAsco9lh2Q-joVp6ZTwjlxnzoeZpSMUw6vSbmQaga5WcntUTjOjDTf_Z1UszVdBkHZT-pOPZemlyOeoBeVo35Y7uXesVXGZx-9HEOOkHhPcrQB2vtIazFadN06zCbm7-vAIpKX7SRno6SfeV09dE-XxUus_9SMDpx8rTHU7aptiIMDh2bRYlyUwrqnZPQjOm8XikCEclkwYTow0duoQ6cUOND1JClnNl9-u4dP2fsvSdh-g4ExJqWuzHQ',
            'rating' => 4.90,
            'sold_count' => 1000,
            'dosage_guidelines' => 'Add 2-3 drops to daily drinking water. Shake well before use.',
            'indication' => 'Aids in molting recovery, stress management, and nutritional deficiency.',
            'pharmacist_note' => 'Change drinking water daily. Protect from direct sunlight.',
        ]);

        Product::create([
            'category_id' => $cats->id,
            'name' => 'Seresto Flea & Tick Collar for Large Dogs (8kg+)',
            'slug' => Str::slug('Seresto Flea & Tick Collar for Large Dogs (8kg+)'),
            'description' => 'Seresto Flea & Tick Collar provides up to 8 months of continuous prevention against fleas, ticks, and lice. Non-toxic, water-resistant, and adjustable.',
            'price' => 615000,
            'stock' => 40,
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuADoQKh4kHJyYJX15swcfzQi0ZjedUy7dzTzK6wLYls3io0jadjUNm9VnXxKj2Tau2kDDgEfLxiBDh-Hj4oP1pV7kOY-xbOMWg3rGYytvanmduF3EHAr_eM_dnewrCCkSB3KFOXmEzaJ7neIP-s3WU2mq8hBW6oRMN7sOQdzVtmqyQ2ltDxXPOWqd5_5HGcDIMWV0Ap57VQM9uFuGCGZmnUAcmOs2YgtM7-7PQpzfmb9kdLkxa1KdxwKA',
            'rating' => 5.00,
            'sold_count' => 3200,
            'dosage_guidelines' => 'Place collar around pet\'s neck. Cut off any excess length. Check fit regularly.',
            'indication' => 'Flea and tick prevention and treatment for 8 months.',
            'pharmacist_note' => 'Water-resistant, odorless, and non-greasy. Safe for puppies from 7 weeks.',
        ]);

        Product::create([
            'category_id' => $cats->id,
            'name' => 'Cosequin Joint Health Cat Supplements 80 Capsules',
            'slug' => Str::slug('Cosequin Joint Health Cat Supplements 80 Capsules'),
            'description' => 'Cosequin is the #1 veterinarian recommended joint health supplement containing Glucosamine and Chondroitin to maintain bladder and joint health in cats.',
            'price' => 340000,
            'stock' => 80,
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCbdWejtKNGPBvvCPcMQIhozmR4w3UavPTR7bpvnfUABVPhLVNtO3zDFRax4QVZ5MV3HmvQ89WcX-SugCiuPPq2KG9hWTZecvFyLVdBij-DsicohQKBKzs7_OcefpGAfGsvQPWcPZyP8SpFfoTJu1Fs4gEkdZ9Lz8ElmA_jf4X3SaVUO3TGjQSA59XbAy2Y9QAN9cUvDvzvQNU3c0xsuY3jJsRX_iRoXgxqmTydg-05WEokcpiCTtnSXQ',
            'rating' => 4.90,
            'sold_count' => 800,
            'dosage_guidelines' => 'Give 1 capsule daily. Can be sprinkled directly on wet food.',
            'indication' => 'Supports joint function, cartilage health, bladder health, and flexibility.',
            'pharmacist_note' => 'For cat use only. Store in a cool, dry place.',
        ]);

        Product::create([
            'category_id' => $cats->id,
            'name' => 'Apoquel (Oclacitinib) Medicated Treatment 3.6mg',
            'slug' => Str::slug('Apoquel (Oclacitinib) Medicated Treatment 3.6mg'),
            'description' => 'Apoquel is a fast-acting, safe treatment to control itching associated with allergic dermatitis in dogs. Starts relieving itch within 4 hours.',
            'price' => 150000,
            'stock' => 120,
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBXeHJTzVy-6gWv8oHs2pH8ngEBJAlty7N9Cz9DC6MbQk39aSroSDCkdGON_bIHKjmq_tMnCEDdlZtmsvxEzXp-qSWvB-sEAyIZZKESsvSSdEVqAxlgirCcrQKqicHmC4XksQoeB6c9ZCi1JGosSlgdCTZGQK3J-zrshMDXp3BHoPuAE3x7HgLqkHvGN0yaducUcO2s_nq6nUxVqqGtcK7cii--NnCNHcBQbm-d5uaBmF47a983AQ1Q1g',
            'rating' => 4.80,
            'sold_count' => 1240,
            'dosage_guidelines' => 'Should be administered twice daily for up to 14 days, then once daily for maintenance. May be given with or without food.',
            'indication' => 'Pruritus and atopic dermatitis in dogs.',
            'pharmacist_note' => 'Store at controlled room temperature 20° to 25°C. For veterinary use only.',
        ]);

        // 4. Seed Settings
        Setting::create(['key' => 'logo', 'value' => '/img/ytm.jpeg']);
        
        // Banner 1
        Setting::create(['key' => 'banner_image_1', 'value' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBUPmxzypNMHfMiYkCk7Yr3kM65t-hMJ0O092cof5zHs0u_3B85M93vvm2RS5ILaCiGFm4QYg_tERKUFK2gDDlkLdZyktGbIAWYY2-ZHlvFpZoerJ8wdppF-Jc-92jB7_Z0MEYqvv3Dv2dxZ1OHJ8CkFxCMcaKw1yztrVQKFSNmg-Bs0h_qr_0dTzOzPLaWdBbYYPmTEJZGpn5FjJFm4105slvqkpzKeD11BiIeed7wKtMg6cEbGIl9Fg']);
        Setting::create(['key' => 'banner_title_1', 'value' => 'Solusi Kesehatan Hewan Terpercaya']);
        Setting::create(['key' => 'banner_subtitle_1', 'value' => 'Distributor resmi obat-obatan dan peralatan medis berkualitas untuk klinik dan apotek hewan.']);
        Setting::create(['key' => 'banner_link_1', 'value' => '/']);
        
        // Banner 2
        Setting::create(['key' => 'banner_image_2', 'value' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDNxN7bLDYs8Ntog2UEH9rEQ3MqMQsWH05Nlpd8cyoxY4qqWd51rfLp6xNZKG_-fbR-d-8lDLlF1wxSF7AGb-OKlGoHDpxL-_BiUB8PsacJlwFD74W0LEMD7mkiCiM66QErUnJGAXRc8tgjPK-K7BL-yHWb6gHoPDRutAkq6fj2gRdWvaQCNTgO8whNvBGfjiTVzRNyHo51zitvWaxQWVdlcOW6MxzWJP3pax2TzhjhGGDyL_4VgOiJOg']);
        Setting::create(['key' => 'banner_title_2', 'value' => 'Grosir Peralatan Medis Hewan']);
        Setting::create(['key' => 'banner_subtitle_2', 'value' => 'Dapatkan penawaran harga khusus dan pasokan medis stabil untuk kelangsungan operasional klinik Anda.']);
        Setting::create(['key' => 'banner_link_2', 'value' => '/']);

        // Banner 3
        Setting::create(['key' => 'banner_image_3', 'value' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAsco9lh2Q-joVp6ZTwjlxnzoeZpSMUw6vSbmQaga5WcntUTjOjDTf_Z1UszVdBkHZT-pOPZemlyOeoBeVo35Y7uXesVXGZx-9HEOOkHhPcrQB2vtIazFadN06zCbm7-vAIpKX7SRno6SfeV09dE-XxUus_9SMDpx8rTHU7aptiIMDh2bRYlyUwrqnZPQjOm8XikCEclkwYTow0duoQ6cUOND1JClnNl9-u4dP2fsvSdh-g4ExJqWuzHQ']);
        Setting::create(['key' => 'banner_title_3', 'value' => 'Suplemen & Nutrisi Hewan Premium']);
        Setting::create(['key' => 'banner_subtitle_3', 'value' => 'Tingkatkan daya tahan dan produktivitas ternak maupun hewan kesayangan Anda dengan vitamin terbaik.']);
        Setting::create(['key' => 'banner_link_3', 'value' => '/']);

        // 5. Seed Reviews
        Review::create([
            'user_id' => 2, // Budi Santoso
            'product_id' => 1, // NexGard
            'rating' => 5,
            'comment' => 'Sangat efektif membasmi kutu pada anjing golden saya. Recommended!'
        ]);
        Review::create([
            'user_id' => 2,
            'product_id' => 2, // Laxatone
            'rating' => 5,
            'comment' => 'Kucing saya sangat suka rasanya dan sekarang bebas dari hairball.'
        ]);
    }
}
