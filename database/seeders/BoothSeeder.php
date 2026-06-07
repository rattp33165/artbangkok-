<?php

namespace Database\Seeders;

use App\Models\BoothHall;
use App\Models\BoothType;
use Illuminate\Database\Seeder;

class BoothSeeder extends Seeder
{
    public function run(): void
    {
        // ── 01 | NEX HALL ─────────────────────────────────────────
        $nexHall = BoothHall::updateOrCreate(
            ['code' => 'nex_hall'],
            ['label' => '01 | NEX HALL', 'description' => '5 booth types (A–E) · 14–25 sqm', 'sort_order' => 1]
        );

        $nexTypes = [
            ['type_code' => 'A', 'label' => 'Type A', 'dimensions' => '5 × 5 m',   'sqm' => 25.0, 'qty' => 10, 'rate_standard' => 6000,  'rate_special' => 3500, 'sort_order' => 1],
            ['type_code' => 'B', 'label' => 'Type B', 'dimensions' => '4 × 6 m',   'sqm' => 24.0, 'qty' => 4,  'rate_standard' => 5760,  'rate_special' => 3360, 'sort_order' => 2],
            ['type_code' => 'C', 'label' => 'Type C', 'dimensions' => '4 × 5 m',   'sqm' => 20.0, 'qty' => 1,  'rate_standard' => 4800,  'rate_special' => 2800, 'sort_order' => 3],
            ['type_code' => 'D', 'label' => 'Type D', 'dimensions' => '3.5 × 5 m', 'sqm' => 17.5, 'qty' => 2,  'rate_standard' => 4200,  'rate_special' => 2450, 'sort_order' => 4],
            ['type_code' => 'E', 'label' => 'Type E', 'dimensions' => '3.5 × 4 m', 'sqm' => 14.0, 'qty' => 4,  'rate_standard' => 3360,  'rate_special' => 1960, 'sort_order' => 5],
        ];

        foreach ($nexTypes as $type) {
            BoothType::updateOrCreate(
                ['hall_id' => $nexHall->id, 'type_code' => $type['type_code']],
                $type
            );
        }

        // ── 02 | ART JEWEL ────────────────────────────────────────
        $artJewel = BoothHall::updateOrCreate(
            ['code' => 'art_jewel'],
            ['label' => '02 | ART JEWEL', 'description' => '2 main booths (J01–J02) · 114.5–229 sqm', 'sort_order' => 2]
        );

        $artTypes = [
            ['type_code' => 'J01',  'label' => 'J01 Full Booth',  'sqm' => 229.0, 'qty' => 1,    'note' => 'Full booth',        'group_key' => 'J01', 'group_label' => 'Main Booth J01 — 229 sqm', 'rate_standard' => 15000, 'rate_special' => 12000, 'sort_order' => 1],
            ['type_code' => 'J01A', 'label' => 'J01A Half-Split', 'sqm' => 114.5, 'qty' => null, 'note' => 'Half-split of J01', 'group_key' => 'J01', 'group_label' => 'Main Booth J01 — 229 sqm', 'rate_standard' => 9000,  'rate_special' => 7000,  'sort_order' => 2],
            ['type_code' => 'J01B', 'label' => 'J01B Half-Split', 'sqm' => 114.5, 'qty' => null, 'note' => 'Half-split of J01', 'group_key' => 'J01', 'group_label' => 'Main Booth J01 — 229 sqm', 'rate_standard' => 8000,  'rate_special' => 6000,  'sort_order' => 3],
            ['type_code' => 'J02',  'label' => 'J02 Full Booth',  'sqm' => 229.0, 'qty' => 1,    'note' => 'Full booth',        'group_key' => 'J02', 'group_label' => 'Main Booth J02 — 229 sqm', 'rate_standard' => 11000, 'rate_special' => 9500,  'sort_order' => 4],
            ['type_code' => 'J02A', 'label' => 'J02A Half-Split', 'sqm' => 114.5, 'qty' => null, 'note' => 'Half-split of J02', 'group_key' => 'J02', 'group_label' => 'Main Booth J02 — 229 sqm', 'rate_standard' => 6500,  'rate_special' => 5500,  'sort_order' => 5],
            ['type_code' => 'J02B', 'label' => 'J02B Half-Split', 'sqm' => 114.5, 'qty' => null, 'note' => 'Half-split of J02', 'group_key' => 'J02', 'group_label' => 'Main Booth J02 — 229 sqm', 'rate_standard' => 6500,  'rate_special' => 5500,  'sort_order' => 6],
        ];

        foreach ($artTypes as $type) {
            BoothType::updateOrCreate(
                ['hall_id' => $artJewel->id, 'type_code' => $type['type_code']],
                $type
            );
        }
    }
}
