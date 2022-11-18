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
            'phone_event' => 'screening_arm_1',
            'phone_variable' => 'scr_telephone',
            'sms_invitations' => '
            {"date_event_0":"screening_arm_1", "date_var_0":"date_enrolled","form_event_0":"screening_arm_1", "form_var_0":"screening_complete", "sms_timer_0":"2","num_days_0":"7","recurrence_0":"2","message_0":"Invite 1: This is dummy test text","date_event_1":"baseline_arm_1", "date_var_1":"date_visit_b","form_event_1":"baseline_arm_1", "form_var_1":"baseline_data_complete","sms_timer_1":"2","num_days_1":"7","recurrence_1":"2","message_1":"Invite 2:  This is a second message."}'
        ];
    }
}
