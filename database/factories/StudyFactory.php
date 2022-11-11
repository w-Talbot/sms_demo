<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Study>
 */
class StudyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'study_name' => $this->faker->company(),
            'api' => $this->faker->creditCardNumber(),
            'url' => $this->faker->url(),
            'sms_invitations' => '
            {"calc_var_0":"[baseline_arm_1][bl_test_date]","logic_0":"[baseline_arm_1][bl_test_value]=\'1\'","sms_timer_0":"10","num_days_0":"7","recurrence_0":"2","message_0":"This is dummy test text","calc_var_1":"[screening_arm_1][scr_test_date]","logic_1":"[screening_arm_1][scr_test_value] = \'0\' OR [screening_arm_1][scr_test_value] = \'\'","sms_timer_1":"10","num_days_1":"7","recurrence_1":"2","message_1":"SMS Message text 2. This is a second message."}'
        ];
    }
}
