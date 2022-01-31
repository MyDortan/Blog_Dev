<?php

namespace Database\Factories;

use App\Models\Post;
use Hekmatinasser\Verta\Traits\Creator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Hekmatinasser\Verta\Verta;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $v = verta()->format('%B / %d / %Y'); // دی 07، 1395;


        return [
            'post_id'=> '40',
            'text' => $this->faker->text,
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'date' => $v,
            'ratio' => $this->faker->numberBetween(1,5) ,
            'like' => $this->faker->numberBetween(1,500),
        ];
    }
}
