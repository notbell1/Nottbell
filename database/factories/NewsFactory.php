<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    public function definition(): array
    {
        // 1. Definisikan Kategori
        $category = $this->faker->randomElement(['Architecture', 'Interior Design', 'Tech Stack', 'Web Development']);

        // 2. Buat Judul yang relevan berdasarkan Kategori
        $titles = [
            'Architecture' => [
                'The Future of Minimalist Skyscrapers in 2026',
                'How Sustainable Materials are Changing Modern Construction',
                'Exploring the Brutalist Architecture Revival',
                'Top 10 Eco-Friendly Buildings You Must See'
            ],
            'Interior Design' => [
                'Biophilic Design: Bringing Nature into Your Living Room',
                'Maximizing Small Spaces with Smart Furniture',
                'The Psychology of Color in Modern Workspace',
                'Vintage vs Modern: Finding the Perfect Balance'
            ],
            'Tech Stack' => [
                'Why Laravel is Still the Best Framework for Enterprises',
                'Mastering Tailwind CSS for High-Performance UI',
                'The Rise of AI-Driven Development Tools',
                'Understanding Microservices Architecture in 2026'
            ],
            'Web Development' => [
                'Improving Core Web Vitals for Better SEO',
                'The Evolution of JavaScript: What to Expect Next',
                'Building Accessible Web Applications for Everyone',
                'Security Best Practices for Modern Fullstack Devs'
            ]
        ];

        // Ambil judul random sesuai kategori, jika tidak ada pakai judul umum
        $title = $this->faker->randomElement($titles[$category] ?? [$this->faker->sentence()]);

        return [
    'title' => $title,
    // Tambahkan random string atau angka di belakang slug agar tidak bentrok
    'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1, 9999),
    'category' => $category,
    'content' => collect($this->faker->paragraphs(6))->map(fn($p) => "<p>$p</p>")->implode(''),
    'author' => 'Nottbell',
    'thumbnail' => 'https://picsum.photos/seed/' . Str::random(10) . '/800/600',
];
    }
}