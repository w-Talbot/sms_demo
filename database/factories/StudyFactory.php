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
            'api' => '2C111D2358053140A761BA3721A8E044',
            'url' => 'https://magcap.phc.ox.ac.uk/demo/api/',
            'phone_event' => 'base_line_arm_1',
            'phone_variable' => 'bl_telephone',
            'sms_invitations' => '
            {"date_event_0":"baseline_arm_1", "date_var_0":"bl_test_date","form_event_0":"screening_arm_1", "form_var_0":"screening_complete", "sms_timer_0":"10","num_days_0":"7","recurrence_0":"2","message_0":"This is dummy test text","date_event_1":"screening_arm_1", "date_var_1":"scr_test_date","form_event_1":"screening_arm_1", "form_var_1":"screening_complete","sms_timer_1":"10","num_days_1":"7","recurrence_1":"2","message_1":"SMS Message text 2. This is a second message."}'
        ];
    }
}
