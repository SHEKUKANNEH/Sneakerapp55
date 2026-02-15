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
            'email' => 'admin@sneakerapp.test',
            'password' => 'password',
            'is_admin' => true,
        ]);

        $users = User::factory(2)->create();

        $fixedSneakers = [
            // Nike sneakers
            [
                'brand' => 'Nike',
                'model' => 'Air Zoom',
                'color' => 'Black/White',
                'price' => 129.99,
                'image_url' => 'https://sportano.de/img/986c30c27a3d26a3ee16c136f92f4ff5/1/9/197593763402_20-jpg/laufschuhe-1291825.jpg',
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
                'image_url' => 'https://www.basketballshop24.de/thumbnail/3f/f0/b9/1697120768/1afb9f3aa077bba0eac6917ccf49da03_1920x1920.jpg',
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
                'image_url' => 'https://assets.adidas.com/images/w_600,f_auto,q_auto/4edaa6d5b65a40d19f20a7fa00ea641f_9366/Stan_Smith_Shoes_White_M20325_01_standard.jpg',
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
                'image_url' => 'https://photos6.spartoo.de/photos/287/28769410/Puma-Suede-XL-28769410_1200_A.jpg',
                'description' => 'Basketball heritage with modern comfort.',
            ],
            // New Balance sneakers
            [
                'brand' => 'New Balance',
                'model' => '480 Classic',
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
                'model' => '327',
                'color' => 'Blue',
                'price' => 109.99,
                'image_url' => 'https://img.joomcdn.net/453acae898befc22688e946cadbe220dd8a3734d_1024_1024.jpeg',
                'description' => 'Retro runner with modern updates.',
            ],
            // Converse sneakers
            [
                'brand' => 'Converse',
                'model' => 'Chuck Taylor',
                'color' => 'Green',
                'price' => 69.99,
                'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314520917304_01?fmt=webp-alpha&bfc=on&wid=500&hei=500',
                'description' => 'Iconic canvas high-top sneaker.',
            ],
            [
                'brand' => 'Converse',
                'model' => 'Chuck 70',
                'color' => 'Black',
                'price' => 89.99,
                'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314550714704_01?fmt=webp-alpha&bfc=on&wid=500&hei=500',
                'description' => 'Premium version of the classic Chuck.',
            ],
            [
                'brand' => 'Converse',
                'model' => 'One Star',
                'color' => 'White',
                'price' => 79.99,
                'image_url' => 'https://cdn.skatedeluxe.com/thumb/FYX0WLqbxLxPR2UFfqkfqO6K3OQ=/fit-in/600x700/filters:fill(white):brightness(-4)/product/145127-0-Converse-CONSOneStarPro.jpg',
                'description' => 'Skateboarding heritage with star logo.',
            ],
            // Reebok sneakers
            [
                'brand' => 'Reebok',
                'model' => 'Club C 85',
                'color' => 'Chalk',
                'price' => 89.99,
                'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314310660304_01?fmt=webp-alpha&bfc=on&wid=500&hei=500',
                'description' => 'Clean tennis-inspired sneaker.',
            ],
            [
                'brand' => 'Reebok',
                'model' => 'Classic Leather',
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
                'image_url' => 'https://www.reebok.eu/cdn/shop/files/JPG-100228246_SLC_eCom.jpg?v=1755600583&width=800',
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
            ['brand' => 'Nike', 'model' => 'Blazer', 'color' => 'Black', 'price' => 89.99, 'image_url' => 'https://intersport-de.imgdn.net/fsi/server?type=image&effects=Pad(cc,ffffff),Matte(FFFFFF)&width=600&height=600&source=marktplatz%2Fproduktiv%2F156%2FCZ1055%2FCZ1055_119_BILD01_20240502.jpg', 'description' => 'Basketball-inspired high-top sneaker.'],
            ['brand' => 'Nike', 'model' => 'React Element', 'color' => 'Gray', 'price' => 139.99, 'image_url' => 'https://intersport-de.imgdn.net/fsi/server?type=image&effects=Pad(cc,ffffff),Matte(FFFFFF)&width=600&height=600&source=marktplatz%2Fproduktiv%2F156%2FCT2423%2FCT2423_500_BILD01_20210928.jpeg', 'description' => 'Modern running shoe with React cushioning.'],
            ['brand' => 'Nike', 'model' => 'Pegasus', 'color' => 'Black', 'price' => 119.99, 'image_url' => 'https://intersport-de.imgdn.net/fsi/server?type=image&effects=Pad(cc,ffffff),Matte(FFFFFF)&width=600&height=600&source=marktplatz%2Fproduktiv%2F156%2FDJ6158%2FDJ6158_001_BILD01_20240802.jpeg', 'description' => 'Versatile running shoe for all distances.'],
            ['brand' => 'Nike', 'model' => 'Shox', 'color' => 'Black/Red', 'price' => 189.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314217102004_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Nike Shox with responsive cushioning technology.'],

            // More Adidas sneakers
            ['brand' => 'Adidas', 'model' => 'Yeezy Boost', 'color' => 'Gray', 'price' => 199.99, 'image_url' => 'https://img.joomcdn.net/4b8cd194f47c0773d31e83ce2a1e4045db907d93_original.jpeg', 'description' => 'Premium lifestyle sneaker with Boost technology.'],
            ['brand' => 'Adidas', 'model' => 'Samba', 'color' => 'Black/White', 'price' => 84.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314313309404_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Iconic indoor soccer-inspired sneaker.'],
            ['brand' => 'Adidas', 'model' => 'Megaride F50', 'color' => '', 'price' => 129.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314218047604_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Modern lifestyle sneaker with Boost midsole.'],
            ['brand' => 'Adidas', 'model' => 'Forum', 'color' => 'Green', 'price' => 94.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314312351704_01?fmt=webp-alpha&bfc=on&wid=500&hei=500'],
            ['brand' => 'Adidas', 'model' => 'Ozweego', 'color' => 'Black', 'price' => 109.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314218526904_01?fmt=webp-alpha&bfc=on&wid=500&hei=500'],
            
            // More Puma sneakers
            ['brand' => 'Puma', 'model' => 'Thunder', 'color' => 'Black/White', 'price' => 119.99, 'image_url' => 'https://cdn-images.farfetch-contents.com/13/55/16/94/13551694_16113272_1000.jpg'],
            ['brand' => 'Puma', 'model' => 'Speedcat', 'color' => 'Red', 'price' => 99.99, 'image_url' => 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcR3UpyysXIAvFKJMU5WMiE24onDFVqzxdookIUmY6LmRLpGOKqeoNItY4H3VyxokTAjJwKbWZJYO1-hlkkrLWqLhPpgfrJbx94LsIAs8KrJdcwStYu3mtFELnEVFXSDVwSu-8QyUQ&usqp=CAc'],
            ['brand' => 'Puma', 'model' => 'Basket', 'color' => 'White', 'price' => 89.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314109409004_01?fmt=webp-alpha&bfc=on&wid=500&hei=500'],
            ['brand' => 'Puma', 'model' => 'All-pro Nitro 2 E.T', 'color' => 'Blue', 'price' => 104.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314109401704_01?fmt=webp-alpha&bfc=on&wid=500&hei=500'],
            ['brand' => 'Puma', 'model' => 'Cell', 'color' => 'Gray', 'price' => 94.99, 'image_url' => 'https://www.schuhcenter.de/out/pictures/generated/product/1/380_340_75/puma_x-cell-nova-fs-sneaker_grau_7575000004666_v1.jpg'],
            
            // More New Balance sneakers
            ['brand' => 'New Balance', 'model' => '550', 'color' => 'White/Green', 'price' => 109.99, 'image_url' => 'https://img.joomcdn.net/58b31f0dc2223e88b9225b30a4cb1416a895d223_1024_1024.jpeg', 'description' => 'Basketball-inspired retro sneaker.'],
            ['brand' => 'New Balance', 'model' => '530', 'color' => 'Gray/Red', 'price' => 99.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314209542704_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => '90s running shoe with modern comfort.'],
            ['brand' => 'New Balance', 'model' => '2002R', 'color' => 'Navy', 'price' => 149.99, 'image_url' => 'https://img.joomcdn.net/9155fd5bc7b603c29462e80174a44c1745ff5dac_original.jpeg'],
            ['brand' => 'New Balance', 'model' => '9060', 'color' => 'Black', 'price' => 129.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314217905604_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Futuristic design with comfort technology.'],
            ['brand' => 'New Balance', 'model' => 'XC-72', 'color' => 'Orange', 'price' => 119.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314216163304_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Retro runner with bold colorways.'],
            
            // More Converse sneakers
            ['brand' => 'Converse', 'model' => 'Converse Shai', 'color' => 'White', 'price' => 64.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314109514704_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Classic low-top canvas sneaker.'],
            ['brand' => 'Converse', 'model' => 'Chuck Taylor High', 'color' => 'Navy', 'price' => 74.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314512266504_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Iconic high-top canvas sneaker.'],
            ['brand' => 'Converse', 'model' => 'Run Star', 'color' => 'Black', 'price' => 99.99, 'image_url' => 'https://img.modivo.cloud/product(8/1/9/d/819d6690f233801d3f6260fae096f5cac594734e_20_0194435159515.jpg,webp)/converse-sneakers-aus-stoff-chuck-taylor-all-star-tectuff-a09485c-schwarz-0000304944758.webp0', 'description' => 'Platform sneaker with chunky sole.'],
            ['brand' => 'Converse', 'model' => 'Jack Purcell', 'color' => 'Blue', 'price' => 79.99, 'image_url' => 'https://assets.footlocker.com/is/image/FLDM/314512278004_01?fmt=webp-alpha&bfc=on&wid=500&hei=500', 'description' => 'Tennis-inspired classic sneaker.'],
            
            // More Reebok sneakers
            ['brand' => 'Reebok', 'model' => 'Instapump Fury', 'color' => 'White/Red', 'price' => 139.99, 'image_url' => 'https://img.joomcdn.net/17396fd4c6aa33deb417a5284689f944da6ed6b6_original.jpeg', 'description' => 'Innovative pump technology sneaker.'],
            ['brand' => 'Reebok', 'model' => 'CL Legacy W', 'color' => 'Black', 'price' => 119.99, 'image_url' => 'https://img.joomcdn.net/20dbca6a2fdf737a84d4a3354c54ff06796f104a_1024_1024.jpeg', 'description' => 'Energy-return running shoe.'],
            ['brand' => 'Reebok', 'model' => 'Classic Leather', 'color' => 'Gray', 'price' => 99.99, 'image_url' => 'https://img.joomcdn.net/389428a183ce89df1f1291fe6de8c8e92f7b162a_1024_1024.jpeg', 'description' => '90s trail running heritage.'],
            ['brand' => 'Reebok', 'model' => 'Workout Plus', 'color' => 'White', 'price' => 89.99, 'image_url' => 'https://img.joomcdn.net/ad00a33670576b5891677ecfe1f8d3577c8c6416_1024_1024.jpeg', 'description' => 'Classic training shoe design.'],
            ['brand' => 'Reebok', 'model' => 'Answer IV', 'color' => 'Red', 'price' => 129.99, 'image_url' => 'https://img.joomcdn.net/8a6455d2fa4995edc23af465497e01c3d85afd6d_original.jpeg', 'description' => 'Basketball heritage with modern tech.'],
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
