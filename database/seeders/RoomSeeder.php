<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\RoomType;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $meetingRoomType = RoomType::where('key', 'meeting_room')->first();
        $workplaceType = RoomType::where('key', 'workplace')->first();
        $conferenceType = RoomType::where('key', 'conference_hall')->first();

        if (!$meetingRoomType || !$workplaceType || !$conferenceType) {
            $this->command->error('Ошибка: Типы помещений не найдены в БД. Проверьте миграции.');
            return;
        }

        Room::create([
            'room_type_id' => $meetingRoomType->id,
            'title' => 'Переговорная "Стратегия"',
            'description' => 'Уютная комната для небольших встреч. Оборудована маркерной доской и ТВ.',
            'address' => 'г. Ижевск, ул. Кирова, 1, офис 101',
            'price_hour' => 1500,
            'price_day' => 8000,
            'image' => 'rooms/image2.jpg',
            'capacity' => 6,
            'work_start' => '08:00',
            'work_end' => '22:00',
        ]);

        Room::create([
            'room_type_id' => $workplaceType->id,
            'title' => 'Open Space Место #5',
            'description' => 'Просторное рабочее место у окна. Высокая скорость интернета.',
            'address' => 'г. Ижевск, ул. Кирова, 1, офис 102',
            'price_hour' => 300,
            'price_day' => 1500,
            'image' => 'rooms/image1.jpeg',
            'capacity' => 1,
            'work_start' => '08:00',
            'work_end' => '22:00',
        ]);

        Room::create([
            'room_type_id' => $conferenceType->id,
            'title' => 'Конференц-зал "Лекторий"',
            'description' => 'Большой зал для презентаций. Проектор, микрофон.',
            'address' => 'г. Ижевск, ул. Кирова, 1, офис 105',
            'price_hour' => 3000,
            'price_day' => 15000,
            'image' => 'rooms/image5.jpg',
            'capacity' => 30,
            'work_start' => '09:00',
            'work_end' => '21:00',
        ]);
         Room::create([
            'room_type_id' => $workplaceType->id,
            'title' => 'Приватная кабина "Фокус"',
            'description' => 'Изолированное рабочее пространство для глубокой концентрации. Полная звукоизоляция.',
            'address' => 'г. Ижевск, ул. Кирова, 1, офис 103',
            'price_hour' => 450,
            'price_day' => 2200,
            'image' => 'rooms/image4.jpg', 
            'capacity' => 1,
            'work_start' => '07:00',
            'work_end' => '23:00',
        ]);
    }
}
