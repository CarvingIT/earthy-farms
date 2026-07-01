<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Farmer;
use App\Models\Plot;
use App\Models\Crop;
use App\Models\Input;
use App\Models\Supply;
use App\Models\SoilReport;
use App\Models\Observation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed or find the test user
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'ECSPL Farms Admin',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Seed Inputs
        $inputsData = [
            ['name' => 'Urea', 'unit' => 'kg'],
            ['name' => 'DAP (Di-Ammonium Phosphate)', 'unit' => 'kg'],
            ['name' => 'MOP (Muriate of Potash)', 'unit' => 'kg'],
            ['name' => 'Neem Cake Manure', 'unit' => 'kg'],
            ['name' => 'Vermicompost', 'unit' => 'kg'],
            ['name' => 'Trichoderma Viride Bio-Fungicide', 'unit' => 'Litre'],
            ['name' => 'Neem Oil Insecticide', 'unit' => 'Litre'],
            ['name' => 'Cocopeat', 'unit' => 'kg'],
        ];
        
        $inputs = [];
        foreach ($inputsData as $inputVal) {
            $inputs[$inputVal['name']] = Input::firstOrCreate(
                ['name' => $inputVal['name']],
                ['unit' => $inputVal['unit']]
            );
        }

        // 3. Seed Farmers
        $farmersData = [
            [
                'name' => 'Rajesh Kumar',
                'location' => '19.9975, 73.7898',
                'address' => 'Gat No. 112, Pimpalgaon Baswant, Nashik, Maharashtra - 422209'
            ],
            [
                'name' => 'Sunita Devi',
                'location' => '29.0588, 76.0856',
                'address' => 'VPO Shamlo Kalan, Jind District, Haryana - 126102'
            ],
            [
                'name' => 'Anil Sharma',
                'location' => '31.6340, 74.8723',
                'address' => 'Bunglow No. 4, Ajnala Road, Near Airport, Amritsar, Punjab - 143001'
            ],
            [
                'name' => 'Venkatesh Prasad',
                'location' => '16.2008, 80.4404',
                'address' => 'Plot No. 45, Amaravathi Road, Guntur, Andhra Pradesh - 522002'
            ],
            [
                'name' => 'Ramesh Patel',
                'location' => '22.3072, 73.1812',
                'address' => 'Plot No. 24, GIDC Estate, Makarpura, Vadodara, Gujarat - 390010'
            ],
            [
                'name' => 'Karan Singh',
                'location' => '26.2389, 73.0243',
                'address' => 'Village Khejarli, Jodhpur District, Rajasthan - 342012'
            ],
            [
                'name' => 'Manoj Gowda',
                'location' => '12.9716, 77.5946',
                'address' => 'Sy No. 54, Maddur Taluk, Mandya District, Karnataka - 571428'
            ],
            [
                'name' => 'Suresh Naidu',
                'location' => '14.4673, 78.8242',
                'address' => 'Door No. 3-88, Rayachoty Road, Kadapa, Andhra Pradesh - 516001'
            ],
            [
                'name' => 'Meena Kumari',
                'location' => '25.6110, 85.1414',
                'address' => 'Village & PO Bihta, Patna District, Bihar - 801103'
            ],
            [
                'name' => 'Balwinder Singh',
                'location' => '30.9010, 75.8573',
                'address' => 'House No. 12, Ferozepur Road, Ludhiana, Punjab - 141012'
            ],
            [
                'name' => 'Karthik Rajan',
                'location' => '11.0168, 76.9558',
                'address' => 'Gat No. 89, Pollachi Main Road, Coimbatore, Tamil Nadu - 641021'
            ],
            [
                'name' => 'Babulal Mahato',
                'location' => '23.3441, 85.3096',
                'address' => 'Village Ormanjhi, Ranchi District, Jharkhand - 835219'
            ],
            [
                'name' => 'Pradeep Bisht',
                'location' => '29.3800, 79.4636',
                'address' => 'Kathgharia, Haldwani, Nainital District, Uttarakhand - 263139'
            ],
            [
                'name' => 'Debashish Banik',
                'location' => '22.9868, 87.8550',
                'address' => 'Sadhanpur Farm Area, Bardhaman, West Bengal - 713101'
            ]
        ];

        $farmers = [];
        foreach ($farmersData as $fd) {
            $farmers[$fd['name']] = Farmer::firstOrCreate(
                ['name' => $fd['name']],
                ['location' => $fd['location'], 'address' => $fd['address']]
            );
        }

        // 4. Seed Plots
        $plotsData = [
            [
                'farmer' => 'Rajesh Kumar',
                'name' => 'Mango Orchard',
                'area' => 3.5
            ],
            [
                'farmer' => 'Rajesh Kumar',
                'name' => 'Grapes Vineyard',
                'area' => 2.0
            ],
            [
                'farmer' => 'Sunita Devi',
                'name' => 'Wheat Field North',
                'area' => 5.0
            ],
            [
                'farmer' => 'Anil Sharma',
                'name' => 'Paddy Field Block A',
                'area' => 4.5
            ],
            [
                'farmer' => 'Venkatesh Prasad',
                'name' => 'Chilli Plantation',
                'area' => 2.5
            ],
            [
                'farmer' => 'Ramesh Patel',
                'name' => 'Cotton Field East',
                'area' => 4.0
            ],
            [
                'farmer' => 'Karan Singh',
                'name' => 'Bajra Field',
                'area' => 6.5
            ],
            [
                'farmer' => 'Manoj Gowda',
                'name' => 'Sugarcane Block 1',
                'area' => 5.5
            ],
            [
                'farmer' => 'Suresh Naidu',
                'name' => 'Banana Plantation',
                'area' => 3.0
            ],
            [
                'farmer' => 'Meena Kumari',
                'name' => 'Potato patch',
                'area' => 1.5
            ],
            [
                'farmer' => 'Balwinder Singh',
                'name' => 'Mustard Block',
                'area' => 3.5
            ],
            [
                'farmer' => 'Karthik Rajan',
                'name' => 'Coconut Grove',
                'area' => 5.0
            ],
            [
                'farmer' => 'Babulal Mahato',
                'name' => 'Tomato Field',
                'area' => 2.0
            ],
            [
                'farmer' => 'Pradeep Bisht',
                'name' => 'Apple Orchard',
                'area' => 2.2
            ],
            [
                'farmer' => 'Debashish Banik',
                'name' => 'Jute Field',
                'area' => 2.8
            ]
        ];

        $plots = [];
        foreach ($plotsData as $pd) {
            $farmer = $farmers[$pd['farmer']];
            $plots[$pd['name']] = Plot::firstOrCreate(
                ['farmer_id' => $farmer->id, 'name' => $pd['name']],
                ['area' => $pd['area']]
            );
        }

        // 5. Seed Crops
        $cropsData = [
            [
                'plot' => 'Mango Orchard',
                'name' => 'Mango',
                'variety' => 'Alphonso (Hapus)',
                'sowing_date' => '2024-06-15',
                'harvest_date' => '2026-05-20',
            ],
            [
                'plot' => 'Grapes Vineyard',
                'name' => 'Grapes',
                'variety' => 'Thompson Seedless',
                'sowing_date' => '2025-10-10',
                'harvest_date' => '2026-03-15',
            ],
            [
                'plot' => 'Wheat Field North',
                'name' => 'Wheat',
                'variety' => 'HD 2967',
                'sowing_date' => '2025-11-15',
                'harvest_date' => '2026-04-10',
            ],
            [
                'plot' => 'Paddy Field Block A',
                'name' => 'Rice',
                'variety' => 'Basmati 370',
                'sowing_date' => '2025-07-01',
                'harvest_date' => '2025-11-10',
            ],
            [
                'plot' => 'Chilli Plantation',
                'name' => 'Chilli',
                'variety' => 'Guntur Teja (S17)',
                'sowing_date' => '2025-08-20',
                'harvest_date' => '2026-02-28',
            ],
            [
                'plot' => 'Cotton Field East',
                'name' => 'Cotton',
                'variety' => 'Bt Cotton',
                'sowing_date' => '2025-06-20',
                'harvest_date' => '2025-12-15',
            ],
            [
                'plot' => 'Bajra Field',
                'name' => 'Bajra',
                'variety' => 'Pioneer 86M84',
                'sowing_date' => '2025-07-10',
                'harvest_date' => '2025-10-15',
            ],
            [
                'plot' => 'Sugarcane Block 1',
                'name' => 'Sugarcane',
                'variety' => 'Co 86032',
                'sowing_date' => '2025-02-10',
                'harvest_date' => '2026-01-25',
            ],
            [
                'plot' => 'Banana Plantation',
                'name' => 'Banana',
                'variety' => 'Grand Naine (G9)',
                'sowing_date' => '2025-03-15',
                'harvest_date' => '2026-03-20',
            ],
            [
                'plot' => 'Potato patch',
                'name' => 'Potato',
                'variety' => 'Kufri Jyoti',
                'sowing_date' => '2025-11-05',
                'harvest_date' => '2026-02-20',
            ],
            [
                'plot' => 'Mustard Block',
                'name' => 'Mustard',
                'variety' => 'Pusa Bold',
                'sowing_date' => '2025-10-25',
                'harvest_date' => '2026-03-10',
            ],
            [
                'plot' => 'Coconut Grove',
                'name' => 'Coconut',
                'variety' => 'East Coast Tall',
                'sowing_date' => '2020-05-01',
                'harvest_date' => '2026-12-31',
            ],
            [
                'plot' => 'Tomato Field',
                'name' => 'Tomato',
                'variety' => 'Arka Rakshak',
                'sowing_date' => '2025-09-10',
                'harvest_date' => '2025-12-20',
            ],
            [
                'plot' => 'Apple Orchard',
                'name' => 'Apple',
                'variety' => 'Royal Delicious',
                'sowing_date' => '2021-01-15',
                'harvest_date' => '2026-09-15',
            ],
            [
                'plot' => 'Jute Field',
                'name' => 'Jute',
                'variety' => 'JRO 524',
                'sowing_date' => '2025-04-15',
                'harvest_date' => '2025-09-10',
            ],
        ];

        $crops = [];
        foreach ($cropsData as $cd) {
            $plot = $plots[$cd['plot']];
            $crops[$cd['plot']] = Crop::firstOrCreate(
                ['plot_id' => $plot->id, 'name' => $cd['name']],
                [
                    'variety' => $cd['variety'],
                    'sowing_date' => $cd['sowing_date'],
                    'harvest_date' => $cd['harvest_date'],
                ]
            );
        }

        // 6. Seed Soil Reports
        $soilReportsData = [
            [
                'plot' => 'Grapes Vineyard',
                'sample_date' => '2025-10-12',
                'Ph' => 7.2, 'EC' => 0.35, 'OC' => 0.65, 'N' => 280.0, 'P' => 24.0, 'K' => 310.0,
                'Boron' => 0.5, 'Fe' => 5.2, 'Zn' => 0.8, 'Cu' => 0.4, 'Mg' => 1.2, 'S' => 12.5,
                'microbial_count' => 1800000
            ],
            [
                'plot' => 'Wheat Field North',
                'sample_date' => '2025-11-18',
                'Ph' => 6.8, 'EC' => 0.42, 'OC' => 0.58, 'N' => 245.0, 'P' => 18.5, 'K' => 290.0,
                'Boron' => 0.4, 'Fe' => 4.8, 'Zn' => 0.75, 'Cu' => 0.35, 'Mg' => 1.0, 'S' => 10.2,
                'microbial_count' => 1400000
            ],
            [
                'plot' => 'Paddy Field Block A',
                'sample_date' => '2025-07-05',
                'Ph' => 6.5, 'EC' => 0.48, 'OC' => 0.72, 'N' => 310.0, 'P' => 28.0, 'K' => 340.0,
                'Boron' => 0.6, 'Fe' => 6.1, 'Zn' => 0.95, 'Cu' => 0.5, 'Mg' => 1.4, 'S' => 14.0,
                'microbial_count' => 2200000
            ],
        ];

        foreach ($soilReportsData as $srd) {
            $crop = $crops[$srd['plot']];
            SoilReport::firstOrCreate(
                ['crop_id' => $crop->id, 'sample_date' => $srd['sample_date']],
                [
                    'Ph' => $srd['Ph'],
                    'EC' => $srd['EC'],
                    'OC' => $srd['OC'],
                    'N' => $srd['N'],
                    'P' => $srd['P'],
                    'K' => $srd['K'],
                    'Boron' => $srd['Boron'],
                    'Fe' => $srd['Fe'],
                    'Zn' => $srd['Zn'],
                    'Cu' => $srd['Cu'],
                    'Mg' => $srd['Mg'],
                    'S' => $srd['S'],
                    'microbial_count' => $srd['microbial_count'],
                ]
            );
        }

        // 7. Seed Supplies
        $suppliesData = [
            [
                'plot' => 'Grapes Vineyard',
                'input' => 'Vermicompost',
                'quantity' => 1500,
                'loading_date' => '2025-10-15',
            ],
            [
                'plot' => 'Grapes Vineyard',
                'input' => 'Neem Cake Manure',
                'quantity' => 300,
                'loading_date' => '2025-10-16',
            ],
            [
                'plot' => 'Grapes Vineyard',
                'input' => 'Trichoderma Viride Bio-Fungicide',
                'quantity' => 10,
                'loading_date' => '2025-11-02',
            ],
            [
                'plot' => 'Wheat Field North',
                'input' => 'Urea',
                'quantity' => 250,
                'loading_date' => '2025-11-20',
            ],
            [
                'plot' => 'Wheat Field North',
                'input' => 'DAP (Di-Ammonium Phosphate)',
                'quantity' => 150,
                'loading_date' => '2025-11-21',
            ],
            [
                'plot' => 'Paddy Field Block A',
                'input' => 'Urea',
                'quantity' => 200,
                'loading_date' => '2025-07-15',
            ],
            [
                'plot' => 'Paddy Field Block A',
                'input' => 'Neem Oil Insecticide',
                'quantity' => 5,
                'loading_date' => '2025-08-10',
            ],
        ];

        foreach ($suppliesData as $sd) {
            $crop = $crops[$sd['plot']];
            $input = $inputs[$sd['input']];
            Supply::firstOrCreate(
                [
                    'crop_id' => $crop->id,
                    'input_id' => $input->id,
                    'loading_date' => $sd['loading_date']
                ],
                ['quantity' => $sd['quantity']]
            );
        }

        // 8. Seed Observations
        $observationsData = [
            [
                'plot' => 'Grapes Vineyard',
                'observation_date' => '2025-11-05',
                'observation' => 'Sprouting of new shoots is healthy. No powdery mildew detected yet.',
            ],
            [
                'plot' => 'Grapes Vineyard',
                'observation_date' => '2025-12-20',
                'observation' => 'Flowering stage initiated. Applied bio-pesticides for flea beetle control.',
            ],
            [
                'plot' => 'Wheat Field North',
                'observation_date' => '2025-12-10',
                'observation' => 'Tillering stage looking excellent. Uniform growth across the field.',
            ],
            [
                'plot' => 'Wheat Field North',
                'observation_date' => '2026-02-15',
                'observation' => 'Earhead emergence started. Irrigation scheduled for next week.',
            ],
            [
                'plot' => 'Paddy Field Block A',
                'observation_date' => '2025-08-15',
                'observation' => 'Weeding completed. Water level maintained at 5cm.',
            ],
            [
                'plot' => 'Paddy Field Block A',
                'observation_date' => '2025-09-30',
                'observation' => 'Panicle initiation stage. Minor incidence of stem borer; sprayed neem oil.',
            ],
        ];

        foreach ($observationsData as $od) {
            $crop = $crops[$od['plot']];
            Observation::firstOrCreate(
                [
                    'crop_id' => $crop->id,
                    'observation_date' => $od['observation_date'],
                    'observation' => $od['observation']
                ]
            );
        }
    }
}
