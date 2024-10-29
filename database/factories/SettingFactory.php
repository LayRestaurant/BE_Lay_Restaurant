<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'theme' => $this->faker->randomElement(['light', 'dark']), // Chọn ngẫu nhiên giữa 'light' và 'dark'
            'language' => $this->faker->randomElement(['en', 'vi', 'fr', 'es']), // Chọn ngẫu nhiên ngôn ngữ
            'notifications_enabled' => $this->faker->boolean(80), // 80% xác suất bật thông báo
            'max_items' => $this->faker->numberBetween(1, 100), // Số lượng tối đa từ 1 đến 100
        ];
    }
}
