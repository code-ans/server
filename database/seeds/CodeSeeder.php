<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CodeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['P', 'Q', 'R', 'T', 'V', 'W', 'X', 'Y', 'Z'],
            ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'm', 'n', 'q', 'r']
        ];

        $picks = ['<= 1Kg', '> 8Kg ~ <= 22Kg', '>= 33Kg'];
        $pnds = ['Easy', 'Difficult', 'HPndful'];
        $positions = ['Loose', 'Tight', 'Approx.' ];

        $codes = [];

        foreach ($data[0] as $first) {
            foreach ($data[1] as $second) {
                $codes[] = $first . $second;
            }
        }

        foreach ($codes as $code) {
            $tmu1 = random_int(3, 20) * 5;
            $tmu2 = $tmu1 + random_int(2, 6);
            $tmu3 = $tmu2 + random_int(2, 4);

            DB::table('code')->insert([
                'code' => $code,
                'pick' => $picks[random_int(0, 2)],
                'pnd' => $pnds[random_int(0, 2)],
                'position' => $positions[random_int(0, 2)],
                'tmu1' => $tmu1,
                'tmu2' => $tmu2,
                'tmu3' => $tmu3
            ]);
        }
    }
}
