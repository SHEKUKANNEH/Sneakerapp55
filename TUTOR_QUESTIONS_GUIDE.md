# Tutor Questions & Commands Guide

## 📚 Potential Tutor Questions About Your Backend

### **1. Models & Relationships**

**Q: Explain the relationships between your models.**
- **Answer**: 
  - `User` has many `Order` (one-to-many)
  - `Sneaker` has many `Order` (one-to-many)
  - `Order` belongs to `User` and `Sneaker` (many-to-one)
  - This creates a many-to-many relationship between Users and Sneakers through Orders

**Q: How do you define relationships in Laravel?**
- **Answer**: Using Eloquent relationship methods:
  - `hasMany()` - One-to-many relationship
  - `belongsTo()` - Many-to-one relationship
  - Defined in the model classes (e.g., `User::orders()`, `Order::user()`)

**Q: What is the `$fillable` property used for?**
- **Answer**: It specifies which attributes can be mass-assigned. This is a security feature to prevent mass assignment vulnerabilities. Only fields in `$fillable` can be assigned using `create()` or `update()`.

**Q: Why do you have `is_admin` in the User model?**
- **Answer**: To differentiate between regular users and administrators. Admins can perform CRUD operations on sneakers, while regular users can only view and place orders.

**Q: How does the `isAdmin()` method work?**
- **Answer**: It's a helper method that returns a boolean indicating if the user is an admin. It checks the `is_admin` attribute and casts it to boolean.

---

### **2. Controllers & CRUD Operations**

**Q: What does CRUD stand for and how is it implemented in your application?**
- **Answer**: 
  - **C**reate - `store()` method in SneakerController
  - **R**ead - `index()` and `show()` methods
  - **U**pdate - `update()` and `updatePrice()` methods
  - **D**elete - `destroy()` method

**Q: Explain the `index()` method in SneakerController.**
- **Answer**: It handles the sneaker listing page with:
  - Search functionality (brand, model, color, description)
  - Filtering by brand and color
  - Pagination (9 items per page)
  - Returns brands and colors for filter dropdowns

**Q: How do you handle validation in your controllers?**
- **Answer**: Using Laravel's `validate()` method:
  - `$request->validate([...])` - validates input and returns errors if invalid
  - Validation rules are defined in arrays (e.g., `'required'`, `'numeric'`, `'max:80'`)
  - Errors are automatically displayed in views using `@error` directive

**Q: What is the difference between `store()` and `update()` methods?**
- **Answer**: 
  - `store()` - Creates a new sneaker record using `Sneaker::create()`
  - `update()` - Updates an existing sneaker using `$sneaker->update()`
  - Both use the same validation method `validateSneaker()`

**Q: Why do you have a separate `updatePrice()` method?**
- **Answer**: It allows admins to update prices inline from the listing page without navigating to the full edit form. It's a convenience feature for quick price updates.

**Q: How does the OrderController calculate total price?**
- **Answer**: `total_price = sneaker->price * quantity`. This is calculated in the `store()` method before saving the order.

---

### **3. Middleware & Security**

**Q: What is middleware and how do you use it?**
- **Answer**: Middleware filters HTTP requests. In this app:
  - `auth` middleware - ensures user is logged in
  - `admin` middleware - ensures user is an admin
  - Applied in controller constructor or route groups

**Q: Explain your AdminMiddleware.**
- **Answer**: 
  - Checks if user is authenticated (`$request->user()`)
  - Checks if user has `is_admin = true`
  - Returns 403 error if not admin
  - Allows request to proceed if admin

**Q: How is the admin middleware registered?**
- **Answer**: In `bootstrap/app.php`, using `$middleware->alias(['admin' => AdminMiddleware::class])`. This creates a shortcut `'admin'` that can be used in routes/controllers.

**Q: What security measures are in place?**
- **Answer**:
  - CSRF protection on all forms (`@csrf`)
  - Password hashing (bcrypt)
  - Mass assignment protection (`$fillable`)
  - Route protection with middleware
  - User authorization (users can only cancel their own orders)
  - SQL injection prevention (Eloquent ORM uses parameterized queries)

**Q: How do you prevent users from accessing admin routes?**
- **Answer**: Using `$this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy'])` in the controller constructor. This restricts these methods to admin users only.

---

### **4. Database & Migrations**

**Q: What are migrations and why use them?**
- **Answer**: Migrations are version control for your database schema. They allow you to:
  - Create/modify database tables
  - Share database structure with team
  - Rollback changes if needed
  - Keep database in sync across environments

**Q: Explain your migrations.**
- **Answer**:
  - `create_users_table` - Creates users table with authentication fields
  - `create_sneakers_table` - Creates sneakers table with product fields
  - `create_orders_table` - Creates orders table with foreign keys
  - `add_is_admin_to_users_table` - Adds admin flag to users

**Q: What are foreign keys and how do you use them?**
- **Answer**: Foreign keys link tables together:
  - `orders.user_id` references `users.id`
  - `orders.sneaker_id` references `sneakers.id`
  - Ensures data integrity (can't delete a user if they have orders)

**Q: What does `migrate:fresh --seed` do?**
- **Answer**: 
  - `migrate:fresh` - Drops all tables and re-runs all migrations
  - `--seed` - Runs the database seeder after migrations
  - Useful for resetting database to initial state with sample data

---

### **5. Routes**

**Q: What is a resource route?**
- **Answer**: `Route::resource('sneakers', SneakerController::class)` automatically creates 7 RESTful routes:
  - GET `/sneakers` - index
  - GET `/sneakers/create` - create form
  - POST `/sneakers` - store
  - GET `/sneakers/{id}` - show
  - GET `/sneakers/{id}/edit` - edit form
  - PUT/PATCH `/sneakers/{id}` - update
  - DELETE `/sneakers/{id}` - destroy

**Q: How do you protect routes?**
- **Answer**: Using middleware groups:
  - `Route::middleware(['auth'])->group(...)` - requires authentication
  - `Route::middleware(['auth', 'admin'])->group(...)` - requires admin
  - Applied in `routes/web.php` or controller constructor

**Q: What is route model binding?**
- **Answer**: Laravel automatically resolves model instances from route parameters:
  - Route: `sneakers/{sneaker}`
  - Controller: `show(Sneaker $sneaker)`
  - Laravel automatically finds the Sneaker by ID and injects it

**Q: Explain the `withQueryString()` method in pagination.**
- **Answer**: Preserves query parameters (search, filters) when navigating between pages. Without it, filters would be lost when clicking "Next" or "Previous".

---

### **6. Validation**

**Q: How do you validate form input?**
- **Answer**: Using `$request->validate()` with validation rules:
  ```php
  $request->validate([
      'brand' => ['required', 'string', 'max:80'],
      'price' => ['required', 'numeric', 'min:0'],
  ]);
  ```

**Q: What happens if validation fails?**
- **Answer**: 
  - User is redirected back to the form
  - Validation errors are stored in session
  - Errors can be displayed using `@error('field')` in Blade templates
  - Old input values are preserved for repopulating the form

**Q: Why validate on both frontend and backend?**
- **Answer**: 
  - Frontend validation improves user experience (immediate feedback)
  - Backend validation is essential for security (users can bypass frontend)
  - Backend validation is the source of truth

---

### **7. Eloquent Queries**

**Q: What is Eloquent?**
- **Answer**: Laravel's ORM (Object-Relational Mapping) that provides an ActiveRecord implementation. It allows you to interact with databases using PHP objects instead of SQL.

**Q: Explain this query: `Sneaker::query()->where('brand', $request->brand)->paginate(9)`**
- **Answer**:
  - `Sneaker::query()` - Starts a query builder
  - `where('brand', $request->brand)` - Filters by brand
  - `paginate(9)` - Returns paginated results (9 per page)
  - Returns a LengthAwarePaginator instance

**Q: What is eager loading and why use it?**
- **Answer**: Loading related models in advance to prevent N+1 queries:
  - `$orders->with('sneaker')` - Loads sneaker data with orders
  - Prevents multiple database queries when accessing `$order->sneaker`

**Q: How do you get distinct values for filters?**
- **Answer**: `Sneaker::distinct()->pluck('brand')`:
  - `distinct()` - Returns unique values
  - `pluck('brand')` - Extracts only the brand column
  - Used to populate filter dropdowns

---

### **8. General Laravel Concepts**

**Q: What is MVC architecture?**
- **Answer**: 
  - **Model** - Data and business logic (Sneaker, User, Order)
  - **View** - Presentation layer (Blade templates)
  - **Controller** - Handles requests, processes data, returns views

**Q: What is dependency injection?**
- **Answer**: Laravel automatically resolves class dependencies:
  - `public function show(Sneaker $sneaker)` - Laravel injects the Sneaker model
  - `public function store(Request $request)` - Laravel injects the Request object

**Q: Explain the request lifecycle.**
- **Answer**:
  1. Request enters `public/index.php`
  2. Routes are matched in `routes/web.php`
  3. Middleware runs (auth, admin, etc.)
  4. Controller method is called
  5. Controller processes request, interacts with models
  6. View is rendered and returned
  7. Response sent to browser

**Q: What is the difference between `create()` and `save()`?**
- **Answer**:
  - `Sneaker::create($data)` - Mass assignment, creates and saves in one step
  - `$sneaker = new Sneaker(); $sneaker->brand = 'Nike'; $sneaker->save()` - Manual assignment, then save

**Q: How does Laravel handle sessions?**
- **Answer**: 
  - Session data stored in database/file/cache
  - Flash messages (like `with('status', 'Success')`) stored in session
  - Available in views using `session('status')`
  - Automatically cleared after being displayed

**Q: What is the purpose of `compact()`?**
- **Answer**: Creates an array from variable names:
  - `compact('sneakers', 'brands')` becomes `['sneakers' => $sneakers, 'brands' => $brands]`
  - Passes variables to the view in a clean way

---

### **9. Advanced Questions**

**Q: How would you add a shopping cart feature?**
- **Answer**: 
  - Create a `Cart` model or use session storage
  - Add routes for add/remove/update cart items
  - Store cart in session or database
  - Modify order creation to process cart items

**Q: How would you implement image upload instead of URLs?**
- **Answer**:
  - Use Laravel's file storage (`Storage::disk('public')`)
  - Add file validation (`'image'`, `'max:2048'`)
  - Store files in `storage/app/public`
  - Create symbolic link: `php artisan storage:link`
  - Store file path instead of URL

**Q: How would you add email notifications for orders?**
- **Answer**:
  - Use Laravel Mail or Notifications
  - Create a Mailable class
  - Send email in OrderController after order creation
  - Configure mail settings in `.env`

**Q: How would you add API endpoints?**
- **Answer**:
  - Create API routes in `routes/api.php`
  - Use API resources for JSON responses
  - Add API authentication (Sanctum/Passport)
  - Return JSON instead of views

---

## 🛠 Frequently Used Commands

### **Artisan Commands (Laravel CLI)**

```bash
# Start development server
php artisan serve
php artisan serve --port=8000
php artisan serve --host=127.0.0.1 --port=8002

# Database commands
php artisan migrate                    # Run pending migrations
php artisan migrate:fresh             # Drop all tables and re-run migrations
php artisan migrate:fresh --seed      # Reset database and seed data
php artisan migrate:rollback          # Rollback last migration
php artisan migrate:status            # Show migration status

# Create files
php artisan make:model Sneaker        # Create model
php artisan make:controller SneakerController  # Create controller
php artisan make:migration create_sneakers_table  # Create migration
php artisan make:middleware AdminMiddleware    # Create middleware
php artisan make:seeder DatabaseSeeder        # Create seeder

# Cache commands
php artisan cache:clear               # Clear application cache
php artisan config:clear              # Clear configuration cache
php artisan route:clear               # Clear route cache
php artisan view:clear                # Clear compiled views

# Other useful commands
php artisan route:list                # List all routes
php artisan tinker                    # Interactive shell
php artisan key:generate              # Generate application key
php artisan storage:link              # Create storage symlink
```

### **Composer Commands (Dependency Management)**

```bash
# Install dependencies
composer install                      # Install all packages
composer update                       # Update all packages
composer require package-name         # Add new package
composer remove package-name          # Remove package

# Autoload
composer dump-autoload                # Regenerate autoload files
```

### **NPM Commands (Frontend Assets)**

```bash
# Install dependencies
npm install                           # Install all packages
npm install package-name              # Add new package

# Build assets
npm run build                         # Build for production
npm run dev                           # Build for development (watch mode)
```

### **Git Commands (Version Control)**

```bash
# Basic git
git status                            # Check file status
git add .                             # Stage all changes
git add filename.php                  # Stage specific file
git commit -m "Your message"          # Commit changes
git push                              # Push to remote
git pull                              # Pull from remote

# Branching
git branch                            # List branches
git checkout -b feature-name          # Create and switch to new branch
git checkout main                     # Switch to main branch

# Remote
git remote -v                         # Show remote repositories
git remote add origin URL             # Add remote repository
```

### **Database Commands (SQLite)**

```bash
# SQLite (if using SQLite)
sqlite3 database/database.sqlite     # Open SQLite database
.tables                               # List all tables
.schema sneakers                      # Show table structure
SELECT * FROM sneakers;               # Query data
.exit                                 # Exit SQLite
```

### **Common Command Combinations**

```bash
# Reset everything and start fresh
php artisan migrate:fresh --seed && npm run build

# Clear all caches
php artisan cache:clear && php artisan config:clear && php artisan route:clear && php artisan view:clear

# Check what routes are available
php artisan route:list | grep sneakers
```

---

## 📝 Quick Reference: Key Concepts

### **MVC Pattern**
- **Model**: `app/Models/Sneaker.php` - Data structure
- **View**: `resources/views/sneakers/index.blade.php` - Presentation
- **Controller**: `app/Http/Controllers/SneakerController.php` - Logic

### **Request Flow**
1. User visits URL → `routes/web.php`
2. Route matches → Controller method
3. Middleware checks → Auth/Admin
4. Controller processes → Model interaction
5. View rendered → Response sent

### **Database Flow**
1. Migration creates table structure
2. Model defines relationships
3. Seeder populates data
4. Controller queries via Eloquent
5. Results passed to view

### **Security Layers**
1. **CSRF Protection** - `@csrf` in forms
2. **Mass Assignment** - `$fillable` array
3. **Middleware** - Route protection
4. **Validation** - Input sanitization
5. **Authorization** - User permission checks

---

## 💡 Tips for Answering Questions

1. **Be Specific**: Use actual code examples from your project
2. **Explain Why**: Don't just say what, explain why you did it that way
3. **Show Relationships**: Draw connections between models, controllers, and views
4. **Mention Security**: Always highlight security considerations
5. **Reference Files**: Know where your code lives (which files, which methods)

---

**Good luck with your tutor! Remember: Understanding the "why" is just as important as knowing the "what".** 🚀


