# SneakerApp - Laravel E-Commerce Application

A full-featured sneaker e-commerce website built with Laravel, featuring CRUD operations, user authentication, admin panel, and order management.

## 📋 Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Technology Stack](#technology-stack)
- [Project Structure](#project-structure)
- [Database Models & Relationships](#database-models--relationships)
- [Installation & Setup](#installation--setup)
- [Usage](#usage)
- [Admin Features](#admin-features)
- [User Features](#user-features)
- [UI/UX Features](#uiux-features)

## 🎯 Overview

SneakerApp is a beginner-friendly Laravel application that demonstrates a complete e-commerce workflow. The application allows users to browse sneakers, place orders, and manage their purchases. Administrators have full CRUD capabilities to manage the sneaker inventory.

## ✨ Features

### Core Functionality

- **Sneaker Management (CRUD)**
  - View all sneakers with pagination (9 per page)
  - Search sneakers by brand, model, color, or description
  - Filter by brand and color
  - View individual sneaker details
  - Create, edit, and delete sneakers (Admin only)
  - Inline price editing (Admin only)

- **User Authentication**
  - User registration and login
  - Password hashing and secure authentication
  - Session management
  - Protected routes with middleware

- **Order Management**
  - Place orders for sneakers
  - View order history
  - Cancel orders
  - Automatic total price calculation

- **Admin Panel**
  - Admin role with `is_admin` flag
  - Restricted access to CRUD operations
  - Admin middleware protection
  - Full inventory management

### UI/UX Features

- **Responsive Design**
  - Modern, clean interface
  - Card-based layout
  - Mobile-friendly navigation

- **Search & Filtering**
  - Real-time search across multiple fields
  - Brand filter dropdown
  - Color filter dropdown
  - Clear filters option

- **Interactive Elements**
  - Image preview in create/edit forms
  - Toast notifications for success messages
  - Delete confirmation modal
  - Inline price editing
  - "View details" button on each sneaker
  - "Back to list" navigation buttons

- **Pagination**
  - Displays 9 sneakers per page
  - Previous/Next navigation
  - Page number display with total count

## 🛠 Technology Stack

- **Backend Framework**: Laravel 12.48.1
- **PHP Version**: 8.4.13
- **Database**: SQLite (can be configured for MySQL)
- **Authentication**: Laravel Fortify
- **Frontend**: Blade Templates, CSS, JavaScript
- **Server**: Herd (local development)

## 📁 Project Structure

```
sneakerapp55/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── SneakerController.php    # Handles sneaker CRUD operations
│   │   │   └── OrderController.php     # Handles order operations
│   │   └── Middleware/
│   │       └── AdminMiddleware.php     # Admin access control
│   └── Models/
│       ├── User.php                     # User model with admin support
│       ├── Sneaker.php                 # Sneaker model
│       └── Order.php                   # Order model
├── database/
│   ├── migrations/                     # Database schema migrations
│   └── seeders/
│       └── DatabaseSeeder.php          # Seeds 48+ sneakers with unique images
├── resources/
│   └── views/
│       ├── components/
│       │   └── layouts/
│       │       └── site.blade.php       # Main layout with header/footer
│       ├── sneakers/
│       │   ├── index.blade.php         # Sneaker listing page
│       │   ├── show.blade.php          # Sneaker detail page
│       │   ├── create.blade.php        # Create sneaker form
│       │   ├── edit.blade.php          # Edit sneaker form
│       │   └── _form.blade.php         # Reusable form partial
│       └── orders/
│           └── index.blade.php         # User orders page
└── routes/
    └── web.php                         # Application routes
```

## 🗄 Database Models & Relationships

### Models

#### 1. **User Model**
- **Attributes**: `name`, `email`, `password`, `is_admin`
- **Relationships**:
  - `hasMany(Order::class)` - A user can have many orders
- **Methods**:
  - `isAdmin()` - Returns true if user is an admin
  - `orders()` - Returns all orders for the user

#### 2. **Sneaker Model**
- **Attributes**: `brand`, `model`, `color`, `price`, `image_url`, `description`
- **Relationships**:
  - `hasMany(Order::class)` - A sneaker can be in many orders
- **Validation**:
  - Brand: required, max 80 characters
  - Model: required, max 80 characters
  - Color: optional, max 80 characters
  - Price: required, numeric, min 0
  - Image URL: required, valid URL, max 255 characters
  - Description: optional, max 500 characters

#### 3. **Order Model**
- **Attributes**: `user_id`, `sneaker_id`, `quantity`, `total_price`, `status`
- **Relationships**:
  - `belongsTo(User::class)` - Each order belongs to a user
  - `belongsTo(Sneaker::class)` - Each order belongs to a sneaker
- **Validation**:
  - Quantity: required, integer, min 1, max 10
  - Total price: automatically calculated (price × quantity)
  - Status: defaults to 'placed'

### Relationships Diagram

```
User (1) ──< (Many) Order (Many) >── (1) Sneaker
```

- One User can have Many Orders
- One Sneaker can be in Many Orders
- Each Order belongs to One User and One Sneaker

## 🚀 Installation & Setup

### Prerequisites

- PHP 8.4.13 or higher
- Composer
- Herd (or any local PHP server)
- Git

### Step-by-Step Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/YOUR_USERNAME/sneakerapp.git
   cd sneakerapp
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate:fresh --seed
   ```
   This will:
   - Create all database tables
   - Seed 48+ sneakers with unique images
   - Create an admin user (email: `admin@sneakerapp.test`, password: `password`)
   - Create 2 regular users
   - Create sample orders

5. **Build frontend assets**
   ```bash
   npm run build
   ```

6. **Start the development server**
   ```bash
   php artisan serve
   # Or using Herd, navigate to your project directory
   ```

7. **Access the application**
   - Home page: `http://127.0.0.1:8000/`
   - Login: `http://127.0.0.1:8000/login`
   - Register: `http://127.0.0.1:8000/register`

## 📖 Usage

### Default Credentials

**Admin User:**
- Email: `admin@sneakerapp.test`
- Password: `password`

**Regular Users:**
- Created via seeder (check database or create new account)

### For Regular Users

1. **Browse Sneakers**
   - Visit the home page to see all sneakers
   - Use search bar to find specific sneakers
   - Filter by brand or color using dropdowns
   - Click "View details" to see full information

2. **Place Orders**
   - Click "View details" on any sneaker
   - Select quantity (1-10)
   - Click "Order Now"
   - View your orders in "My Orders" section

3. **Manage Orders**
   - View all your orders in "My Orders"
   - Cancel orders if needed

### For Admin Users

1. **Manage Sneakers**
   - **Add Sneaker**: Click "Add Sneaker" button on home page
   - **Edit Sneaker**: Click "Edit" button on any sneaker card
   - **Delete Sneaker**: Click "Delete" button (with confirmation)
   - **Update Price**: Use inline price editor on sneaker cards

2. **Full CRUD Access**
   - Create new sneakers with image preview
   - Edit existing sneakers
   - Delete sneakers (with confirmation modal)
   - Update prices inline without leaving the page

## 🔐 Admin Features

### Admin Middleware

The `AdminMiddleware` protects admin-only routes:
- `/sneakers/create` - Create sneaker
- `/sneakers/{id}/edit` - Edit sneaker
- `/sneakers/{id}` (DELETE) - Delete sneaker
- `/sneakers/{id}/price` (PATCH) - Update price

### Admin-Only UI Elements

- "Add Sneaker" button (only visible to admins)
- "Edit" button on sneaker cards
- "Delete" button on sneaker cards
- Inline price editing form
- "Edit Sneaker" and "Delete" buttons on detail page

## 👤 User Features

### Public Access (No Login Required)

- View all sneakers
- Search and filter sneakers
- View sneaker details
- See prices and descriptions

### Authenticated User Access

- Place orders
- View order history
- Cancel orders
- Access "My Orders" page

## 🎨 UI/UX Features

### Search & Filtering

- **Search Bar**: Search across brand, model, color, and description
- **Brand Filter**: Dropdown with all available brands
- **Color Filter**: Dropdown with all available colors
- **Clear Filters**: Button to reset all filters

### Interactive Elements

- **Image Preview**: Real-time preview when creating/editing sneakers
- **Toast Notifications**: Success messages appear as toast notifications
  - Auto-dismiss after 4 seconds
  - Manual close button
  - Slide-in animation

- **Delete Confirmation Modal**: 
  - Prevents accidental deletions
  - Shows sneaker name
  - Requires explicit confirmation

- **Inline Price Editing**: 
  - Admins can update prices directly from the listing page
  - No need to navigate to edit page
  - Instant updates with success notification

### Navigation

- **Header Navigation**:
  - "SneakerApp" logo links to home (left side)
  - Auth links on right side:
    - Login/Register (for guests)
    - My Orders/Logout (for authenticated users)

- **Breadcrumb Navigation**:
  - "Back to list" button on edit/show pages
  - "View details" button on each sneaker card

### Pagination

- Displays 9 sneakers per page
- Shows current page and total pages
- Previous/Next navigation buttons
- Disabled state for first/last page
- Total count display

## 📊 Database Schema

### Users Table
- `id` (primary key)
- `name`
- `email` (unique)
- `password` (hashed)
- `is_admin` (boolean, default: false)
- `email_verified_at` (nullable)
- `remember_token`
- `created_at`, `updated_at`

### Sneakers Table
- `id` (primary key)
- `brand`
- `model`
- `color` (nullable)
- `price` (decimal)
- `image_url`
- `description` (nullable)
- `created_at`, `updated_at`

### Orders Table
- `id` (primary key)
- `user_id` (foreign key to users)
- `sneaker_id` (foreign key to sneakers)
- `quantity` (integer)
- `total_price` (decimal)
- `status` (string, default: 'placed')
- `created_at`, `updated_at`

## 🔄 Routes

### Public Routes
- `GET /` - Home page (sneaker listing)
- `GET /sneakers` - Sneaker listing (same as home)
- `GET /sneakers/{id}` - View sneaker details
- `GET /login` - Login page
- `GET /register` - Registration page

### Authenticated Routes
- `GET /orders` - User's order history
- `POST /sneakers/{id}/orders` - Place an order
- `DELETE /orders/{id}` - Cancel an order

### Admin Routes
- `GET /sneakers/create` - Create sneaker form
- `POST /sneakers` - Store new sneaker
- `GET /sneakers/{id}/edit` - Edit sneaker form
- `PUT /sneakers/{id}` - Update sneaker
- `DELETE /sneakers/{id}` - Delete sneaker
- `PATCH /sneakers/{id}/price` - Update price inline

## 🧪 Seeded Data

The database seeder creates:
- **1 Admin User**: `admin@sneakerapp.test` / `password`
- **2 Regular Users**: Randomly generated
- **48+ Sneakers**: Diverse brands (Nike, Adidas, Puma, New Balance, Converse, Reebok)
- **Sample Orders**: Orders linking users to sneakers

Each sneaker has:
- Unique image URL
- Brand, model, color, price
- Description
- Proper relationships with orders

## 🛡 Security Features

- Password hashing (bcrypt)
- CSRF protection on all forms
- Admin middleware protection
- User authorization for orders
- SQL injection prevention (Eloquent ORM)
- XSS protection (Blade templating)

## 📝 Code Quality

- **MVC Architecture**: Clean separation of concerns
- **Eloquent Relationships**: Proper use of Laravel relationships
- **Form Validation**: Comprehensive validation rules
- **Middleware**: Route protection and authorization
- **Blade Components**: Reusable view components
- **RESTful Routes**: Standard Laravel resource routes

## 🚧 Future Enhancements

Potential features to add:
- Payment integration
- Shopping cart functionality
- Order status tracking
- Email notifications
- User profiles
- Product reviews and ratings
- Image upload instead of URLs
- Advanced filtering (price range, size)
- Wishlist functionality

## 📄 License

This project is open-source and available for educational purposes.

## 👨‍💻 Author

Built as a learning project for Laravel beginners.

## 🙏 Acknowledgments

- Laravel Framework
- Laravel Fortify for authentication
- All sneaker brands featured in the application

---

**Note**: This application is built for educational purposes and demonstrates core Laravel concepts including CRUD operations, authentication, relationships, and middleware.

