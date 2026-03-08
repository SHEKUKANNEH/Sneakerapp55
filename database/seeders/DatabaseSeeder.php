<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Sneaker;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => 'password',
            'is_admin' => true,
        ]);

        $users = User::factory(2)->create();

        $fixedSneakers = [
            // Nike sneakers
            [
                'brand' => 'Nike',
                'model' => 'Air Zoom',
                'color' => 'Black/Blue',
                'price' => 129.99,
                'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314209421404_01?fmt=webp-alpha&bfc=on&wid=500&hei=500',
                'description' => 'Lightweight running shoe for daily training.',
            ],
            [
                'brand' => 'Nike',
                'model' => 'Air Max',
                'color' => 'Red',
                'price' => 159.99,
                'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314217549204_01?fmt=webp-alpha&bfc=on&wid=500&hei=500',
                'description' => 'Classic comfort with visible air cushioning.',
            ],
            [
                'brand' => 'Nike',
                'model' => 'Dunk Low',
                'color' => 'Blue',
                'price' => 119.99,
                'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314109257304_01?fmt=webp-alpha&bfc=on&wid=500&hei=500',
                'description' => 'Basketball-inspired street style.',
            ],
            // Adidas sneakers
            [
                'brand' => 'Adidas',
                'model' => 'Ultraboost',
                'color' => 'Cloud White',
                'price' => 149.99,
                'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314218553304_01?fmt=webp-alpha&bfc=on&wid=500&hei=500',
                'description' => 'Comfort-focused shoe with soft cushioning.',
            ],
            [
                'brand' => 'Adidas',
                'model' => 'Stan Smith',
                'color' => 'Green',
                'price' => 89.99,
                'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314208388604_01?fmt=webp-alpha&bfc=on&wid=500&hei=500',
                'description' => 'Iconic tennis shoe with clean design.',
            ],
            [
                'brand' => 'Adidas',
                'model' => 'Superstar',
                'color' => 'Black',
                'price' => 99.99,
                'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314312407704_01?fmt=webp-alpha&bfc=on&wid=500&hei=500',
                'description' => 'Classic shell-toe design.',
            ],
            // Puma sneakers
            [
                'brand' => 'Puma',
                'model' => 'RS-X',
                'color' => 'Gray/Orange',
                'price' => 109.99,
                'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314218380104_01?fmt=webp-alpha&bfc=on&wid=500&hei=500',
                'description' => 'Retro style with a chunky modern shape.',
            ],
            [
                'brand' => 'Puma',
                'model' => 'Suede Classic',
                'color' => 'Red',
                'price' => 79.99,
                'image_url' => 'https://image.schuhe.de/image/upload/t_sde/f_auto/q_auto:best/w_624,h_624/v1677695000/schuhede/1058051/1058051-01.png',
                'description' => 'Timeless suede basketball shoe.',
            ],
            [
                'brand' => 'Puma',
                'model' => 'Clyde',
                'color' => 'White',
                'price' => 89.99,
                'image_url' => 'https://assets.footlocker.com/is/image/FLDM/315349282202_01?fmt=webp-alpha&bfc=on&wid=500&hei=500',
                'description' => 'Basketball heritage with modern comfort.',
            ],
            // New Balance sneakers
            [
                'brand' => 'New Balance',
                'model' => '480',
                'color' => 'Navy',
                'price' => 99.99,
                'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314109928904_01?fmt=webp-alpha&bfc=on&wid=500&hei=500',
                'description' => 'Everyday sneaker with classic suede finish.',
            ],
            [
                'brand' => 'New Balance',
                'model' => '2002R',
                'color' => 'Gray',
                'price' => 179.99,
                'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314209138404_01?fmt=webp-alpha&bfc=on&wid=500&hei=500',
                'description' => 'Premium running shoe with superior comfort.',
            ],
            [
                'brand' => 'New Balance',
                'model' => '9060',
                'color' => 'Blue',
                'price' => 109.99,
                'image_url' => 'https://assets.footlocker.com/is/image/FLDM/315217164102_01?fmt=webp-alpha&bfc=on&wid=500&hei=500',
                'description' => 'Retro runner with modern updates.',
            ],
            // Converse sneakers
            [
                'brand' => 'Converse',
                'model' => 'CT',
                'color' => 'Green',
                'price' => 69.99,
                'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314520917304_01?fmt=webp-alpha&bfc=on&wid=500&hei=500',
                'description' => 'Iconic canvas high-top sneaker.',
            ],
            [
                'brand' => 'Converse',
                'model' => 'C7',
                'color' => 'Black',
                'price' => 89.99,
                'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314550714704_01?fmt=webp-alpha&bfc=on&wid=500&hei=500',
                'description' => 'Premium version of the classic Chuck.',
            ],
            [
                'brand' => 'Converse',
                'model' => '1T',
                'color' => 'White',
                'price' => 79.99,
                'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314520254104_01?fmt=webp-alpha&bfc=on&wid=500&hei=500',
                'description' => 'Skateboarding heritage with star logo.',
            ],
            // Reebok sneakers
            [
                'brand' => 'Reebok',
                'model' => 'Club',
                'color' => 'Chalk',
                'price' => 89.99,
                'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314310660304_01?fmt=webp-alpha&bfc=on&wid=500&hei=500',
                'description' => 'Clean tennis-inspired sneaker.',
            ],
            [
                'brand' => 'Reebok',
                'model' => 'Classic 1',
                'color' => 'Navy',
                'price' => 99.99,
                'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314215350704_01?fmt=webp-alpha&bfc=on&wid=500&hei=500',
                'description' => 'Vintage style with premium leather.',
            ],
            [
                'brand' => 'Reebok',
                'model' => 'Question',
                'color' => 'Red',
                'price' => 119.99,
                'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314310663704_01?fmt=webp-alpha&bfc=on&wid=500&hei=500',
                'description' => 'Basketball heritage with modern design.',
            ],
        ];

        $sneakers = collect($fixedSneakers)->map(function ($data) {
            return Sneaker::create($data);
        });

        // Add 30 more sneakers with diverse brands and colors - each with unique image URLs
        $additionalSneakers = [
            // More Nike sneakers
            ['brand' => 'Nike', 'model' => 'Air Force 1', 'color' => 'White', 'price' => 99.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/316705874804_01?fmt=webp-alpha&bfc=on&wid=500&hei=500'],
            ['brand' => 'Nike', 'model' => 'Cortez', 'color' => 'Green', 'price' => 79.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/315216895102_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Retro running shoe with heritage design.'],
            ['brand' => 'Nike', 'model' => 'Blazer', 'color' => 'Black', 'price' => 89.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314109505504_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Basketball-inspired high-top sneaker.'],
            ['brand' => 'Nike', 'model' => 'React Element', 'color' => 'Gray', 'price' => 139.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314209397604_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Modern running shoe with React cushioning.'],
            ['brand' => 'Nike', 'model' => 'Pegasus', 'color' => 'Black', 'price' => 119.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/244209668904_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Versatile running shoe for all distances.'],
            ['brand' => 'Nike', 'model' => 'Shox', 'color' => 'Black/Red', 'price' => 189.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314217102004_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Nike Shox with responsive cushioning technology.'],

            // More Adidas sneakers
            ['brand' => 'Adidas', 'model' => 'Spezial', 'color' => 'Gray', 'price' => 199.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314311980404_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Premium lifestyle sneaker with Boost technology.'],
            ['brand' => 'Adidas', 'model' => 'Samba', 'color' => 'Black/White', 'price' => 84.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314313309404_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Iconic indoor soccer-inspired sneaker.'],
            ['brand' => 'Adidas', 'model' => 'Ultra', 'color' => 'Black', 'price' => 84.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314218047604_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Modern lifestyle sneaker with Boost midsole.'],
            ['brand' => 'Adidas', 'model' => 'Forum', 'color' => 'Green', 'price' => 94.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314312351704_01?fmt=webp-alpha&bfc=on&wid=500&hei=500'],
            ['brand' => 'Adidas', 'model' => 'Ozweego', 'color' => 'Black', 'price' => 109.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314218526904_01?fmt=webp-alpha&bfc=on&wid=500&hei=500'],
            
            // More Puma sneakers
            ['brand' => 'Puma', 'model' => 'Velocity NT', 'color' => 'Black/White', 'price' => 119.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314218030204_01?fmt=webp-alpha&bfc=on&wid=500&hei=500'],
            ['brand' => 'Puma', 'model' => 'Speedcat', 'color' => 'Red', 'price' => 99.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314311995204_01?fmt=webp-alpha&bfc=on&wid=500&hei=500'],
            ['brand' => 'Puma', 'model' => 'Basket', 'color' => 'White', 'price' => 89.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314109409004_01?fmt=webp-alpha&bfc=on&wid=500&hei=500'],
            ['brand' => 'Puma', 'model' => 'All-pro Nitro', 'color' => 'Blue', 'price' => 104.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314109401704_01?fmt=webp-alpha&bfc=on&wid=500&hei=500'],
            ['brand' => 'Puma', 'model' => 'Cell', 'color' => 'Gray', 'price' => 94.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314109406604_01?fmt=webp-alpha&bfc=on&wid=500&hei=500'],
            // More New Balance sneakers
            ['brand' => 'New Balance', 'model' => 'Abzorb', 'color' => 'White/Green', 'price' => 109.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314217911404_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Basketball-inspired retro sneaker.'],
            ['brand' => 'New Balance', 'model' => '530', 'color' => 'Gray/White', 'price' => 99.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314209542704_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => '90s running shoe with modern comfort.'],
            ['brand' => 'New Balance', 'model' => 'FFT', 'color' => 'Navy', 'price' => 149.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/315216605402_01?fmt=webp-alpha&bfc=on&wid=500&hei=500'],
            ['brand' => 'New Balance', 'model' => '9060', 'color' => 'Black', 'price' => 129.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314217905604_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Futuristic design with comfort technology.'],
            ['brand' => 'New Balance', 'model' => 'XC-72', 'color' => 'Orange', 'price' => 119.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314216163304_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Retro runner with bold colorways.'],
            
            // More Converse sneakers
            ['brand' => 'Converse', 'model' => 'Shai', 'color' => 'White', 'price' => 64.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314109514704_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Classic low-top canvas sneaker.'],
            ['brand' => 'Converse', 'model' => 'Ctas ox', 'color' => 'Green', 'price' => 74.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314520976904_01?fmt=webp-alpha&bfc=on&wid=500&hei=500'],
            ['brand' => 'Converse', 'model' => 'Run Star', 'color' => 'Black', 'price' => 99.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314521080904_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Suede texture.'],
            ['brand' => 'Converse', 'model' => 'J Purcell', 'color' => 'Blue', 'price' => 79.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314512278004_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Tennis-inspired classic sneaker.'],
            
            // More Reebok sneakers
            ['brand' => 'Reebok', 'model' => 'C Leather', 'color' => 'White/Red', 'price' => 139.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314215350704_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Innovative pump technology sneaker.'],
            ['brand' => 'Reebok', 'model' => 'High Top', 'color' => 'Black', 'price' => 119.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314310662904_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Energy-return running shoe.'],
            ['brand' => 'Reebok', 'model' => 'ATR CH', 'color' => 'Gray', 'price' => 99.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314311661004_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => '90s trail running heritage.'],
            ['brand' => 'Reebok', 'model' => 'Club C85', 'color' => 'White', 'price' => 89.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314310660304_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Classic training shoe design.'],
            ['brand' => 'Reebok', 'model' => 'Answer IV', 'color' => 'Red', 'price' => 129.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314311663604_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Basketball heritage with modern tech.'],
        ];

        $additionalSneakersCollection = collect($additionalSneakers)->map(function ($data) {
            return Sneaker::create($data);
        });

        $sneakers = $sneakers->merge($additionalSneakersCollection);

        foreach (range(1, 5) as $count) {
            $user = collect([$admin])->merge($users)->random();
            $sneaker = $sneakers->random();
            $quantity = random_int(1, 3);

            Order::create([
                'user_id' => $user->id,
                'sneaker_id' => $sneaker->id,
                'quantity' => $quantity,
                'total_price' => $sneaker->price * $quantity,
                'status' => 'placed',
            ]);
        }
    }
}
