<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = collect([
            // Main Courses
            [
                'category_id' => 1,
                'name' => 'Grilled Chicken Breast',
                'ingredients' => 'Chicken breast, olive oil, garlic, lemon, herbs',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 1,
                'name' => 'Pan-Seared Salmon',
                'ingredients' => 'Salmon fillet, butter, lemon, dill, salt, pepper',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 1,
                'name' => 'Filet Mignon',
                'ingredients' => 'Beef tenderloin, salt, black pepper, butter, thyme',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 1,
                'name' => 'Chicken Marsala',
                'ingredients' => 'Chicken breast, Marsala wine, mushrooms, garlic',
            ],

            [
                'category_id' => 1,
                'name' => 'Veal Parmesan',
                'ingredients' => 'Veal cutlet, marinara sauce, mozzarella, Parmesan, pasta',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 1,
                'name' => 'Lemon Herb Tilapia',
                'ingredients' => 'Tilapia fillet, lemon, olive oil, parsley, thyme',
            ],

            [
                'category_id' => 1,
                'name' => 'Beef Stroganoff',
                'ingredients' => 'Beef strips, onions, mushrooms, sour cream, mustard',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 1,
                'name' => 'Honey Glazed Ham',
                'ingredients' => 'Ham, honey, brown sugar, cloves, pineapple',
            ],

            [
                'category_id' => 1,
                'name' => 'Stuffed Bell Peppers',
                'ingredients' => 'Bell peppers, ground beef, rice, tomatoes, cheese',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 1,
                'name' => 'Teriyaki Glazed Tofu',
                'ingredients' => 'Tofu, teriyaki sauce, sesame oil, green onions',
            ],

            // Salads
            [
                'category_id' => 2,
                'name' => 'Caesar Salad',
                'ingredients' => 'Romaine lettuce, croutons, Caesar dressing, Parmesan cheese',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 2,
                'name' => 'Greek Salad',
                'ingredients' => 'Cucumbers, tomatoes, olives, feta cheese, red onion',
            ],

            [
                'category_id' => 2,
                'name' => 'Caprese Salad',
                'ingredients' => 'Tomatoes, fresh mozzarella, basil, balsamic glaze',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 2,
                'name' => 'Cobb Salad',
                'ingredients' => 'Lettuce, chicken breast, bacon, avocado, blue cheese',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 2,
                'name' => 'Spinach and Strawberry Salad',
                'ingredients' => 'Baby spinach, strawberries, almonds, feta, balsamic vinaigrette',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 2,
                'name' => 'Asian Chicken Salad',
                'ingredients' => 'Mixed greens, grilled chicken, mandarin oranges, sesame dressing',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 2,
                'name' => 'Mediterranean Quinoa Salad',
                'ingredients' => 'Quinoa, cherry tomatoes, cucumbers, Kalamata olives, feta',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 2,
                'name' => 'Tuna Nicoise Salad',
                'ingredients' => 'Tuna, potatoes, green beans, boiled eggs, olives',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 2,
                'name' => 'Waldorf Salad',
                'ingredients' => 'Apples, celery, grapes, walnuts, mayonnaise',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 2,
                'name' => 'Southwest Chicken Salad',
                'ingredients' => 'Grilled chicken, black beans, corn, avocado, cilantro lime dressing',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            // Seafood
            [
                'category_id' => 3,
                'name' => 'Grilled Salmon',
                'ingredients' => 'Salmon fillet, lemon, herbs, olive oil',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 3,
                'name' => 'Shrimp Scampi',
                'ingredients' => 'Shrimp, garlic, white wine, lemon, parsley',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 3,
                'name' => 'Lobster Tail',
                'ingredients' => 'Lobster tail, butter, garlic, lemon, parsley',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 3,
                'name' => 'Clam Linguine',
                'ingredients' => 'Clams, linguine, garlic, white wine, parsley',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 3,
                'name' => 'Miso Glazed Cod',
                'ingredients' => 'Cod fillet, miso paste, soy sauce, ginger, mirin',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 3,
                'name' => 'Cioppino',
                'ingredients' => 'Assorted seafood (shrimp, mussels, clams), tomatoes, broth',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 3,
                'name' => 'Crab Cakes',
                'ingredients' => 'Crab meat, breadcrumbs, mayonnaise, mustard, Old Bay seasoning',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 3,
                'name' => 'Scallop Risotto',
                'ingredients' => 'Scallops, Arborio rice, white wine, Parmesan, shallots',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 3,
                'name' => 'Tuna Poke Bowl',
                'ingredients' => 'Ahi tuna, soy sauce, sesame oil, avocado, rice',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 3,
                'name' => 'Grilled Swordfish',
                'ingredients' => 'Swordfish steak, lemon, garlic, herbs',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            // Desserts
            [
                'category_id' => 4,
                'name' => 'Chocolate Lava Cake',
                'ingredients' => 'Chocolate, butter, eggs, sugar, flour',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 4,
                'name' => 'New York Cheesecake',
                'ingredients' => 'Cream cheese, sugar, eggs, sour cream, vanilla extract',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 4,
                'name' => 'Tiramisu',
                'ingredients' => 'Ladyfingers, mascarpone cheese, coffee, cocoa powder',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 4,
                'name' => 'Strawberry Shortcake',
                'ingredients' => 'Sponge cake, strawberries, whipped cream',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 4,
                'name' => 'Molten Caramel Brownies',
                'ingredients' => 'Brownie mix, caramel sauce, pecans, chocolate chips',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 4,
                'name' => 'Panna Cotta',
                'ingredients' => 'Heavy cream, sugar, gelatin, vanilla bean',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 4,
                'name' => 'Apple Pie',
                'ingredients' => 'Apples, sugar, cinnamon, pie crust',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 4,
                'name' => 'Chocolate Mousse',
                'ingredients' => 'Chocolate, heavy cream, eggs, sugar',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 4,
                'name' => 'Red Velvet Cupcakes',
                'ingredients' => 'Red velvet cake mix, cream cheese frosting',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 4,
                'name' => 'Fruit Sorbet',
                'ingredients' => 'Assorted fruits, sugar, lemon juice',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            // Breakfast
            [
                'category_id' => 5,
                'name' => 'Classic Pancakes',
                'ingredients' => 'Flour, milk, eggs, baking powder, butter',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 5,
                'name' => 'French Toast',
                'ingredients' => 'Bread, eggs, milk, cinnamon, vanilla extract',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 5,
                'name' => 'Vegetarian Omelette',
                'ingredients' => 'Eggs, bell peppers, onions, tomatoes, cheese',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 5,
                'name' => 'Avocado Toast',
                'ingredients' => 'Whole wheat bread, avocado, cherry tomatoes, olive oil',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 5,
                'name' => 'Eggs Benedict',
                'ingredients' => 'English muffin, poached eggs, Canadian bacon, hollandaise sauce',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 5,
                'name' => 'Greek Yogurt Parfait',
                'ingredients' => 'Greek yogurt, granola, mixed berries, honey',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 5,
                'name' => 'Breakfast Burrito',
                'ingredients' => 'Tortilla, scrambled eggs, black beans, salsa, cheese',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 5,
                'name' => 'Blueberry Muffins',
                'ingredients' => 'Flour, sugar, blueberries, milk, butter',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 5,
                'name' => 'Smoked Salmon Bagel',
                'ingredients' => 'Bagel, smoked salmon, cream cheese, capers, red onion',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 5,
                'name' => 'Acai Bowl',
                'ingredients' => 'Acai berries, banana, granola, coconut flakes',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            // Kids Menu
            [
                'category_id' => 6,
                'name' => 'Cheesy Macaroni and Cheese',
                'ingredients' => 'Macaroni pasta, cheddar cheese sauce',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 6,
                'name' => 'Mini Cheese Pizza',
                'ingredients' => 'Mini pizza crust, tomato sauce, mozzarella cheese',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 6,
                'name' => 'Chicken Nuggets',
                'ingredients' => 'Chicken breast nuggets, breadcrumbs, ketchup',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 6,
                'name' => 'Peanut Butter and Jelly Sandwich',
                'ingredients' => 'Bread, peanut butter, jelly',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 6,
                'name' => 'Grilled Cheese Sandwich',
                'ingredients' => 'Bread, cheddar cheese, butter',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 6,
                'name' => 'Mini Corn Dogs',
                'ingredients' => 'Mini hot dogs, cornmeal batter, ketchup',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 6,
                'name' => 'Fish Sticks',
                'ingredients' => 'Breaded fish fillets, tartar sauce',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 6,
                'name' => 'Vegetable Quesadilla',
                'ingredients' => 'Flour tortilla, cheese, mixed vegetables',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 6,
                'name' => 'Dinosaur-Shaped Chicken Tenders',
                'ingredients' => 'Chicken tenders, breadcrumbs, barbecue sauce',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 6,
                'name' => 'Fruit Kabobs',
                'ingredients' => 'Assorted fruits on skewers',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            // Burgers
            [
                'category_id' => 7,
                'name' => 'Classic Cheeseburger',
                'ingredients' => 'Beef patty, cheese, lettuce, tomato, onion, ketchup, mustard',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 7,
                'name' => 'Bacon BBQ Burger',
                'ingredients' => 'Beef patty, bacon, cheddar cheese, BBQ sauce, lettuce, onion',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 7,
                'name' => 'Veggie Burger',
                'ingredients' => 'Vegetarian patty, lettuce, tomato, onion, pickles, mayo',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 7,
                'name' => 'Mushroom Swiss Burger',
                'ingredients' => 'Beef patty, Swiss cheese, sautéed mushrooms, lettuce, mayo',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 7,
                'name' => 'Double Bacon Cheeseburger',
                'ingredients' => 'Two beef patties, bacon, American cheese, lettuce, tomato',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 7,
                'name' => 'Spicy Jalapeño Burger',
                'ingredients' => 'Beef patty, pepper jack cheese, jalapeños, lettuce, chipotle mayo',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 7,
                'name' => 'Avocado Turkey Burger',
                'ingredients' => 'Turkey patty, avocado, Swiss cheese, lettuce, tomato, cranberry sauce',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 7,
                'name' => 'Blue Cheese Buffalo Burger',
                'ingredients' => 'Buffalo burger, blue cheese, lettuce, tomato, buffalo sauce',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 7,
                'name' => 'Teriyaki Pineapple Burger',
                'ingredients' => 'Beef patty, teriyaki glaze, grilled pineapple, lettuce, onion',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 7,
                'name' => 'Beyond Meat Burger',
                'ingredients' => 'Beyond Meat patty, vegan cheese, lettuce, tomato, vegan mayo',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            // Pasta
            [
                'category_id' => 8,
                'name' => 'Spaghetti Bolognese',
                'ingredients' => 'Ground beef, tomatoes, onions, garlic, Italian herbs, spaghetti',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 8,
                'name' => 'Fettuccine Alfredo',
                'ingredients' => 'Fettuccine pasta, heavy cream, butter, Parmesan cheese',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 8,
                'name' => 'Chicken Pesto Pasta',
                'ingredients' => 'Chicken breast, penne pasta, basil pesto, cherry tomatoes',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 8,
                'name' => 'Lobster Ravioli',
                'ingredients' => 'Lobster-filled ravioli, tomato cream sauce, basil',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 8,
                'name' => 'Vegetarian Lasagna',
                'ingredients' => 'Lasagna noodles, ricotta cheese, spinach, marinara sauce',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 8,
                'name' => 'Carbonara',
                'ingredients' => 'Spaghetti, pancetta, eggs, Parmesan cheese, black pepper',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 8,
                'name' => 'Shrimp Scampi Linguine',
                'ingredients' => 'Shrimp, linguine pasta, garlic, white wine, lemon',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 8,
                'name' => 'Penne alla Vodka',
                'ingredients' => 'Penne pasta, vodka sauce, crushed red pepper, Parmesan',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 8,
                'name' => 'Mushroom Risotto',
                'ingredients' => 'Arborio rice, mushrooms, onions, vegetable broth, Parmesan',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 8,
                'name' => 'Eggplant Parmesan',
                'ingredients' => 'Eggplant slices, marinara sauce, mozzarella, Parmesan',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            // Vegetarian
            [
                'category_id' => 9,
                'name' => 'Vegetable Stir-Fry',
                'ingredients' => 'Assorted vegetables, tofu, soy sauce, ginger, garlic',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 9,
                'name' => 'Quinoa Salad Bowl',
                'ingredients' => 'Quinoa, mixed greens, cherry tomatoes, cucumber, feta',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 9,
                'name' => 'Eggplant and Chickpea Curry',
                'ingredients' => 'Eggplant, chickpeas, tomatoes, coconut milk, curry spices',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 9,
                'name' => 'Mushroom and Spinach Lasagna',
                'ingredients' => 'Lasagna noodles, mushrooms, spinach, ricotta cheese, marinara sauce',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 9,
                'name' => 'Caprese Stuffed Portobello Mushrooms',
                'ingredients' => 'Portobello mushrooms, tomatoes, mozzarella, basil, balsamic glaze',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 9,
                'name' => 'Vegetarian Burrito',
                'ingredients' => 'Black beans, rice, bell peppers, onions, guacamole, salsa',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 9,
                'name' => 'Spinach and Ricotta Stuffed Shells',
                'ingredients' => 'Jumbo pasta shells, spinach, ricotta cheese, marinara sauce',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 9,
                'name' => 'Sweet Potato and Black Bean Enchiladas',
                'ingredients' => 'Sweet potatoes, black beans, corn tortillas, enchilada sauce',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 9,
                'name' => 'Chickpea and Vegetable Curry',
                'ingredients' => 'Chickpeas, mixed vegetables, coconut milk, curry spices',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 9,
                'name' => 'Vegetarian Sushi Roll',
                'ingredients' => 'Sushi rice, avocado, cucumber, carrots, nori, soy sauce',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            // Drinks
            [
                'category_id' => 10,
                'name' => 'Classic Lemonade',
                'ingredients' => 'Freshly squeezed lemons, sugar, water, ice',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 10,
                'name' => 'Iced Coffee',
                'ingredients' => 'Cold brew coffee, milk, sugar, ice',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 10,
                'name' => 'Strawberry Smoothie',
                'ingredients' => 'Strawberries, yogurt, banana, honey, ice',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 10,
                'name' => 'Mango Tango Mocktail',
                'ingredients' => 'Mango juice, orange juice, pineapple juice, soda, ice',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 10,
                'name' => 'Peach Iced Tea',
                'ingredients' => 'Peach tea, sugar, lemon, ice',
                'discount_price' => null,
                'discount_end_date' => null,
            ],

            [
                'category_id' => 10,
                'name' => 'Cucumber Mint Cooler',
                'ingredients' => 'Cucumber, mint leaves, lime juice, simple syrup, soda, ice',
            ],

            [
                'category_id' => 10,
                'name' => 'Watermelon Slush',
                'ingredients' => 'Fresh watermelon, lime, sugar, ice',
            ],

            [
                'category_id' => 10,
                'name' => 'Coconut Pineapple Smoothie',
                'ingredients' => 'Coconut milk, pineapple, banana, ice',
            ],

            [
                'category_id' => 10,
                'name' => 'Blueberry Lemonade',
                'ingredients' => 'Blueberries, freshly squeezed lemons, sugar, water, ice',
            ],

            [
                'category_id' => 10,
                'name' => 'Espresso Martini',
                'ingredients' => 'Espresso, vodka, coffee liqueur, simple syrup, ice',
                'discount_price' => null,
                'discount_end_date' => null,
            ],
        ]);

        $products->each(fn (Product $product) => Product::factory()->create($product));
    }
}
