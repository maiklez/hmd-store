<?php

namespace Database\Factories\data\Models;

use App\Data\Models\Contact;
use App\Data\Models\Provider;
use App\Data\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    public function getContactIds()
    {
        return $this->faker->randomElement([
            [ 'contact_type' => Provider::class, 'contact_id' => Provider::factory() ],
            [ 'contact_type' => Store::class, 'contact_id' => Store::factory() ],
        ]);
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $contact = $this->getContactIds();
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'contact_type' => $contact['contact_type'],
            'contact_id' => $contact['contact_id'],
        ];
    }
}
