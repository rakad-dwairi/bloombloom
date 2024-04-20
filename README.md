# Eyewear Store API

This API provides endpoints for managing frames, lenses, and orders for an eyewear store.

# Installation

Clone the repository.
Install dependencies with `composer install`.
Copy `.env.example` to `.env` and configure your database settings.
Run migrations with `php artisan migrate`.
Seed the database with `php artisan db:seed`.




# Post Method

http://127.0.0.1:8000/api/auth/register

form-data: username: rakad
           password: password

------------------------------------------

# Post Method

http://127.0.0.1:8000/api/auth/login

-- Admin in Seeder --
form-data: username: admin
           password: password

---------------------------------------------

# Post Method

http://127.0.0.1:8000/api/frames

{
    "name": "tearess",
    "description": "Updated Frame Description",
    "price": 29.99,
    "currency": "usd",
    "status": "active",
    "stock": 50
}


---------------------------------------------

# Update (Put) Method

http://127.0.0.1:8000/api/frames/{id}

{
    "name": "tearess",
    "description": "Updated Frame Description",
    "price": 29.99,
    "currency": "usd",
    "status": "active",
    "stock": 50
}
    

---------------------------------------------

# Delete Method

http://127.0.0.1:8000/api/frames/{id}


---------------------------------------------

# Post Method

http://127.0.0.1:8000/api/lens

{
    "colour": "nig",
    "description": "Test",
    "prescription_type": "fashion",
    "lens_type": "blue_light",
    "stock": "3",
    "currency": "usd",
    "price": "3"
}



---------------------------------------------

# Update (Put) Method

http://127.0.0.1:8000/api/lens/{id}

{
    "colour": "nig",
    "description": "Test",
    "prescription_type": "fashion",
    "lens_type": "blue_light",
    "stock": "3",
    "currency": "usd",
    "price": "3"
}

    

---------------------------------------------

# Delete Method

http://127.0.0.1:8000/api/lens/{id}


---------------------------------------------

# Get Method

http://127.0.0.1:8000/api/orders/create

{
    "frame_id": 1, 
    "lens_id": 1,
    "currency": "usd"
}

