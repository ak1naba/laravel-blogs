<?php

namespace Database\Seeders;

use App\Models\NewItem;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create([
            'email' => 'admin@mail.ru',
            'password' => Hash::make('qweqweqwe'),
            'name' => 'admin',
            'role' => 'admin'
        ]);

        $writer1 = User::create([
            'email' => 'writer1@mail.ru',
            'password' => Hash::make('qweqweqwe'),
            'name' => 'Writer One',
            'role' => 'writer'
        ]);

        $writer2 = User::create([
            'email' => 'writer2@mail.ru',
            'password' => Hash::make('qweqweqwe'),
            'name' => 'Writer Two',
            'role' => 'writer'
        ]);

        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'email' => "user{$i}@mail.ru",
                'password' => Hash::make('qweqweqwe'),
                'name' => "User {$i}",
                'role' => 'user'
            ]);
        }

        // Вставка новостей writer1 через модель пакетами
        $batchSize = 1000;
        $news = [];

        for ($i = 1; $i <= 50000; $i++) {
            $news[] = [
                'user_id' => $writer1->id,
                'title' => "Новость #{$i}",
                'text' => "Текст новости номер {$i}.",
                'published' => (bool) rand(0, 1),
            ];

            if (count($news) === $batchSize) {
                NewItem::insert($news);
                $news = [];
            }
        }

        if (!empty($news)) {
            NewItem::insert($news);
        }

        // Вставка новостей writer2 через модель
        $news = [];

        for ($i = 50001; $i <= 100000; $i++) {
            $news[] = [
                'user_id' => $writer2->id,
                'title' => "Новость #{$i}",
                'text' => "Текст новости номер {$i}.",
                'published' => (bool) rand(0, 1),
            ];

            if (count($news) === $batchSize) {
                NewItem::insert($news);
                $news = [];
            }
        }

        if (!empty($news)) {
            NewItem::insert($news);
        }
    }
}
