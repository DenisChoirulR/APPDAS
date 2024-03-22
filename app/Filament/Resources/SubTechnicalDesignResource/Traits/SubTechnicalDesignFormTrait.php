<?php

namespace App\Filament\Resources\SubTechnicalDesignResource\Traits;

use App\Enums\ActivityGroupEnum;
use Filament\Forms;
trait SubTechnicalDesignFormTrait
{
    use Step1FormTrait, Step2FormTrait, Step3FormTrait, Step4FormTrait;

    protected static function subTechnicalDesignForm(): array
    {
        return [
            Forms\Components\Wizard::make([
                Forms\Components\Wizard\Step::make('Informasi Dasar')
                    ->schema(self::step1Form()),
                Forms\Components\Wizard\Step::make('Tanaman')
                    ->schema(self::step2Form())
                    ->hiddenOn('edit')
                    ->afterValidation(function (Forms\Get $get, Forms\Set $set){
                        $plan_types = $get('plant_types');

                        // Initialize data arrays for each activity category
                        $data_plants_0 = [];
                        $data_plants_1 = [];
                        $data_plants_2 = [];

                        // Get plants for each activity category
                        $plants_p0 = $get('plants_p0');
                        $plants_p1 = $get('plants_p1');
                        $plants_p2 = $get('plants_p2');

                        // Convert plants to collections for easier manipulation
                        $plants_p0_collection = collect($plants_p0);
                        $plants_p1_collection = collect($plants_p1);
                        $plants_p2_collection = collect($plants_p2);

                        // Iterate through each plan type
                        foreach ($plan_types as $plan_type) {
                            // Get plant details for P0 activity category
                            $s_plants_p0 = $plants_p0_collection->firstWhere('plant_name', $plan_type['plant_type_name']);
                            if ($s_plants_p0) {
                                // If plant details exist, add them to data_plants_0 array
                                $data_plants_0[] = [
                                    'activity_category' => ActivityGroupEnum::P0->name,
                                    'plant_name' => $plan_type['plant_type_name'],
                                    'number_of_plant' => $s_plants_p0['number_of_plant'] ?? null
                                ];
                            } else {
                                // If plant details do not exist, add only activity_category and plant_name to data_plants_0 array
                                $data_plants_0[] = [
                                    'activity_category' => ActivityGroupEnum::P0->name,
                                    'plant_name' => $plan_type['plant_type_name']
                                ];
                            }

                            // Get plant details for P1 activity category
                            $s_plants_p1 = $plants_p1_collection->firstWhere('plant_name', $plan_type['plant_type_name']);
                            if ($s_plants_p1) {
                                // If plant details exist, add them to data_plants_1 array
                                $data_plants_1[] = [
                                    'activity_category' => ActivityGroupEnum::P1->name,
                                    'plant_name' => $plan_type['plant_type_name'],
                                    'number_of_plant' => $s_plants_p1['number_of_plant'] ?? null
                                ];
                            } else {
                                // If plant details do not exist, add only activity_category and plant_name to data_plants_1 array
                                $data_plants_1[] = [
                                    'activity_category' => ActivityGroupEnum::P1->name,
                                    'plant_name' => $plan_type['plant_type_name']
                                ];
                            }

                            // Get plant details for P2 activity category
                            $s_plants_p2 = $plants_p2_collection->firstWhere('plant_name', $plan_type['plant_type_name']);
                            if ($s_plants_p2) {
                                // If plant details exist, add them to data_plants_2 array
                                $data_plants_2[] = [
                                    'activity_category' => ActivityGroupEnum::P2->name,
                                    'plant_name' => $plan_type['plant_type_name'],
                                    'number_of_plant' => $s_plants_p2['number_of_plant'] ?? null
                                ];
                            } else {
                                // If plant details do not exist, add only activity_category and plant_name to data_plants_2 array
                                $data_plants_2[] = [
                                    'activity_category' => ActivityGroupEnum::P2->name,
                                    'plant_name' => $plan_type['plant_type_name']
                                ];
                            }
                        }

                        // Set the modified data arrays back to the original variables
                        $set('plants_p0', $data_plants_0);
                        $set('plants_p1', $data_plants_1);
                        $set('plants_p2', $data_plants_2);
                    }),
                Forms\Components\Wizard\Step::make('Rencana Tanam')
                    ->schema(self::step3Form()),
                Forms\Components\Wizard\Step::make('Kegiatan Social')
                    ->schema(self::step4Form())
            ])
        ];
    }
}
