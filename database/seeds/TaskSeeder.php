<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $codeLibs = DB::table('code')->get();

        $taskTypes = [
            'Single Station',
            'Turning Station (Simple)',
            'Turning Station (Complex)',
            'Coverage Station'
        ];

        $optTypes = [
            'in_door',
            'wait_process',
            'out_door',
            'wait_till_end'
        ];

        $timeTypes = [ 'welding_time', 'turning_time', 'setup_time' ];

        for ($n = 0; $n < 300; $n++) {
            $operators = [];
            for ($i = 0; $i < random_int(1, 2); $i++) {
                $codes = [];
                foreach ($optTypes as $key => $type) {
                    $codes[$type] = [];

                    if ($type === 'wait_till_end') $len = 1;
                    else $len = random_int(1, 6);

                    for ($j = 0; $j < $len; $j++) {
                        $code = $codeLibs[random_int(0, sizeof($codes) - 1)];

                        $codes[$type][] = [
                            'code_and_distance' => $code->code . random_int(1, 3),
                            'frequence' => random_int(1, 5),
                            'divider' => random_int(1, 3),
                            'type' => 1,
                        ];
                    }

                    if ($type === 'wait_till_end') continue;
                    for ($j; $j < random_int(2, 3); $j++) {
                        $codes[$type][] = [
                            'code_and_distance' => '',
                            'frequence' => '',
                            'divider' => '',
                            'type' => ''
                        ];
                    }
                }
                $operators[] = [
                    'name' => 'Operator ' . ($i + 1),
                    'codes' => $codes
                ];
            }

            DB::table('task')->insert([
                'type' => $taskTypes[random_int(0, 3)],
                'description' => 'Test Description ' . random_int(1000, 9999),
                'plant' => 'Test Plant ' . random_int(1000, 9999),
                'area' => 'Test Area ' . random_int(1000, 9999),
                'cost_center' => 'Test Cost Center ' . random_int(1000, 9999),
                'welding_time' => random_int(0, 5) ? random_int(50, 100) : 0,
                'turning_time' => random_int(0, 10) ? random_int(50, 100) : 0,
                'setup_time' => random_int(0, 15) ? random_int(50, 100) : 0,
                'operators' => json_encode($operators)
            ]);
        }
    }
}
