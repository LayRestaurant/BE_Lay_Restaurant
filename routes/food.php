<?php

use App\Http\Controllers\BookingFoodItemController;
use App\Http\Controllers\BookingFoodController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\UserController;

Route::get('/foods', [FoodController::class, 'index']);
Route::get('/foods/filter/{price}', [FoodController::class, 'filter']);
Route::get('/foods/prices', [FoodController::class, 'getAllPrice']);
Route::get('/foods/types', [FoodController::class, 'getAllType']);
Route::get('/foods/types/{type}', [FoodController::class, 'getFoodByType']);
Route::get('/foods/sort/{type}', [FoodController::class, 'sortByPrice']);
Route::get('/admin/foods', [FoodController::class, 'adminIndex']);
Route::get('/foods/{id}', [FoodController::class, 'show']);
Route::get('/foods/{id}/edit', [FoodController::class, 'getForUpdate']);
Route::delete('/foods/{id}', [FoodController::class, 'destroy']);
Route::post('/foods', [FoodController::class, 'create']);
Route::put('/foods/{id}', [FoodController::class, 'update']);
Route::post('/foods/search', [FoodController::class, 'search']);

Route::get('/shopping-carts', [ShoppingCartController::class, 'index']);
Route::post('/shopping-carts', [ShoppingCartController::class, 'store']);
Route::get('/shopping-carts/{food_id}', [ShoppingCartController::class, 'show']);
Route::put('/shopping-carts/{id}', [ShoppingCartController::class, 'update']);
Route::delete('/shopping-carts/{food_id}', [ShoppingCartController::class, 'destroy']);
Route::post('/shopping-carts/set-quantity', [ShoppingCartController::class, 'setQuantityOrder']);

Route::post('/add-new-address', [UserController::class, 'addNewAddressDelivery']);

// Route group for API routes
Route::prefix('booking-food')->group(function () {
    // Get all bookings
    Route::get('/', [BookingFoodController::class, 'index']); // -> done

    // Get a specific booking by ID
    Route::get('/{id}', [BookingFoodController::class, 'show']); // -> done

    // Create a new booking
    Route::post('/', [BookingFoodController::class, 'store']);
    // example data
    // {
    //     "user_id": 1,
    //     "order_number": "ORD12345",
    //     "order_date": "2024-07-23",
    //     "total_amount": 150.00,
    //     "status": "Pending",
    //     "payment_method": "Credit Card",
    //     "delivery_address": "123 Main St, Anytown, Vietnam",
    //     "note": "Please deliver by evening."
    // } -> done


    // Update an existing booking by ID
    Route::put('/{id}', [BookingFoodController::class, 'update']);
    // example data
    // {
    //     "user_id": 1,                      // Ensure this user ID exists in your 'users' table
    //     "order_number": "ORD12346",        // New unique order number (different from other orders)
    //     "order_date": "2024-07-24",        // Valid date in YYYY-MM-DD format
    //     "total_amount": 175.00,            // Numeric value for the total amount
    //     "status": "Confirmed",             // Status as a string (e.g., 'Pending', 'Confirmed')
    //     "payment_method": "PayPal",        // Payment method as a string
    //     "delivery_address": "789 Pine St, Anytown, Vietnam", // New delivery address
    //     "note": "Please call before delivery." // Optional note
    // }

    // content_type : Application
    // token
    // --> done


    // Delete a booking by ID
    Route::delete('/{id}', [BookingFoodController::class, 'destroy']);

    // Get bookings by user ID
    Route::get('/user/{userId}', [BookingFoodController::class, 'getBookingFoodsByUserId']);
    // Explanation:
    // GET /booking-food/ - Retrieves all bookings.
    // GET /booking-food/{id} - Retrieves a specific booking by its ID.
    // POST /booking-food/ - Creates a new booking.
    // PUT /booking-food/{id} - Updates an existing booking by its ID.
    // DELETE /booking-food/{id} - Deletes a specific booking by its ID.
    // GET /booking-food/user/{userId} - Retrieves all bookings for a specific user by their ID.
});


// Route group for API routes
Route::prefix('booking-food-items')->group(function () {
    // Get all booking food items
    Route::get('/', [BookingFoodItemController::class, 'index']);

    // Get a specific booking food item by ID
    Route::get('/{id}', [BookingFoodItemController::class, 'show']);

    // Create a new booking food item
    Route::post('/', [BookingFoodItemController::class, 'store']);

    // Update an existing booking food item by ID
    Route::put('/{id}', [BookingFoodItemController::class, 'update']);

    // Delete a booking food item by ID
    Route::delete('/{id}', [BookingFoodItemController::class, 'destroy']);
    // Explanation:
    // GET /booking-food-items/ - Retrieves all booking food items.
    // GET /booking-food-items/{id} - Retrieves a specific booking food item by its ID.
    // POST /booking-food-items/ - Creates a new booking food item.
    // PUT /booking-food-items/{id} - Updates an existing booking food item by its ID.
    // DELETE /booking-food-items/{id} - Deletes a specific booking food item by its ID.
});
