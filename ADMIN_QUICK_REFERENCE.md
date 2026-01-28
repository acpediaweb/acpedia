# Admin Panel - Quick Reference Guide

## Login & Access

```
Admin Panel URL: http://localhost:8080/admin
Requirement: role_id = 1 in users table
```

## Directory Navigation

| Module | List View | Detail/Edit | Controller |
|--------|-----------|-------------|-----------|
| Dashboard | `/admin` | N/A | `Dashboard.php` |
| Orders | `/admin/orders` | `/admin/orders/:id` | `Orders.php` |
| Products | `/admin/products` | `/admin/products/:id/edit` | `Products.php` |
| Inventory | `/admin/inventory` | `/admin/inventory/:id` | `Inventory.php` |
| Timeline | `/admin/timeline` | `/admin/timeline/:id` | `Timeline.php` |
| Employees | `/admin/employee` | `/admin/employee/:id` | `Employee.php` |
| Forum | `/admin/forum` | `/admin/forum/:id` | `Forum.php` |
| Users | `/admin/users` | `/admin/users/:id/edit` | `Users.php` |
| Config | `/admin/config` | N/A | `SiteConfig.php` |

## Common Operations

### Create/Edit Product
1. Navigate to `/admin/products`
2. Click "Add Product" button
3. Fill form:
   - Name, description, price
   - Brand, type, unit
   - Upload main image
   - Add extra attributes with dynamic form
   - Select categories
4. Click "Create Product"

### Manage Order
1. Navigate to `/admin/orders`
2. Filter by status or search by ID
3. Click "View Details" on order
4. Change status from dropdown
5. Click "Update Status"

### Bind Inventory Item
1. Navigate to `/admin/inventory`
2. Click "View" on item
3. Enter user ID and address ID (optional)
4. Click "Install to User"

### View Employee Time Tracking
1. Navigate to `/admin/employee`
2. Click "View Details" on employee
3. See today's summary (hours, status)
4. View recent clock records with duration

### Manage Forum Thread
1. Navigate to `/admin/forum`
2. Click "Moderate" on thread
3. View all posts with author info
4. Click "Close Thread" to prevent replies
5. Click "Reopen Thread" to allow replies again

### Create User
1. Navigate to `/admin/users`
2. Click "Create User"
3. Fill form (name, email, phone, role, password)
4. Click "Create User"
5. New user can now login

## Database Tables Referenced

- `orders` - Order headers
- `order_items` - Order line items
- `products` - Product catalog
- `brands` - Product brands
- `product_types` - Product types
- `categories` - Product categories
- `product_categories` - Many-to-many junction
- `inventory` - Individual physical items
- `inventory_logs` - Item action history
- `users` - User accounts
- `roles` - User roles
- `staff_clock_logs` - Employee time tracking
- `forum` - Forum threads
- `forum_posts` - Thread replies
- `forum_flairs` - User badges/titles

## Form Validation Rules

### Product
- name: required, 3-255 chars
- description: required
- price: required, numeric
- brand_id: required, numeric
- product_type_id: required, numeric
- unit: required, 1-50 chars

### Order Status Update
- status: must be one of (Pending, In Progress, Completed, Cancelled)

### User
- fullname: required, 3-255 chars
- email: required, valid email, unique
- role_id: required, numeric
- password: required for create, min 6 chars

### Inventory Bind
- user_id: required, numeric
- address_id: optional, numeric

## API Endpoints (For AJAX)

### Update Order Status
```
POST /admin/orders/:id/update-status
Body: { status: 'Completed' }
```

### Bind Inventory
```
POST /admin/inventory/:id/bind
Body: { user_id: 5, address_id: 3 }
```

### Unbind Inventory
```
POST /admin/inventory/:id/unbind
```

### Close Forum Thread
```
POST /admin/forum/:id/close
```

### Reopen Forum Thread
```
POST /admin/forum/:id/reopen
```

### Delete Product
```
POST /admin/products/:id/delete
```

### Delete User
```
POST /admin/users/:id/delete
```

## Filters Available

### Orders List
- Search: by order ID
- Filter: by status (Pending, In Progress, Completed, Cancelled)

### Products List
- Search: by product name
- Filter: by brand

### Inventory List
- Filter: by product, brand, type
- Items per page: 20, 50, 100

### Timeline List
- Filter: by inventory item ID, action type
- Action types: created, assigned, unassigned, serviced

### Employees List
- Search: by name
- Filter: by role (Technician, Staff)

### Forum List
- Search: by thread title
- Filter: by status (Open, Closed)

### Users List
- Search: by name, email, phone
- Filter: by role

## Pagination

Default items per page:
- Orders: 15
- Products: 20
- Users: 20
- Employees: 15
- Forum: 20
- Timeline: 25
- Inventory: 20 (configurable: 20, 50, 100)

## File Uploads

- Location: `/writable/uploads/`
- URL format: `/file/uploads/{filename}`
- Supported: Images (jpg, png, gif, webp)
- Multiple uploads: Yes (for products)
- Max file size: Depends on server config

## Troubleshooting

### "Admin access only" error
- Ensure user is logged in with role_id = 1
- Check session is active

### Images not displaying
- Verify FileController exists at `app/Controllers/FileController.php`
- Check AdminFilter is registered in `app/Config/Filters.php`
- Confirm files are in `writable/uploads/`

### 404 on admin routes
- Verify routes are added to `app/Config/Routes.php`
- Check controller files exist in `app/Controllers/Admin/`
- Ensure namespace is correct: `App\Controllers\Admin`

### Database errors
- Check table names match (lowercase, with underscores)
- Verify models point to correct table names
- Ensure database connection is active

## View Template Inheritance

All admin views extend `admin-layout.php`:
```php
<?= $this->extend('admin/admin-layout') ?>
<?= $this->section('content') ?>
  <!-- page content here -->
<?= $this->endSection() ?>
```

## Color Codes (Tailwind)

| Status | Class | Color |
|--------|-------|-------|
| Active/Success | `bg-green-900` `text-green-200` | Green |
| Pending/Warning | `bg-yellow-900` `text-yellow-200` | Yellow |
| Processing | `bg-blue-900` `text-blue-200` | Blue |
| Inactive/Error | `bg-red-900` `text-red-200` | Red |
| Info | `bg-purple-900` `text-purple-200` | Purple |
| Default | `bg-gray-700` | Gray |

## JavaScript Features

### Add Attribute Field (Products)
- Click "+ Add Attribute" button
- New key-value field pair added
- Click "Remove" to delete
- All handled by `addAttribute` function in form.php

## Performance Notes

- Dashboard queries optimized with joins
- Pagination prevents loading all records
- Select specific fields in queries (not SELECT *)
- Use distinct() to avoid duplicate rows in joins
- Proper indexing recommended on:
  - orders.order_status
  - inventory.assigned_to_user_id
  - users.role_id
  - forum.is_closed

## Security Best Practices

1. Always check user role before sensitive operations
2. Validate all form inputs
3. Use CSRF tokens on all forms (csrf_field())
4. Sanitize user input with esc()
5. Use parameterized queries (handled by ORM)
6. Implement action logging for audit trail
7. Never expose sensitive data in URLs
8. Use HTTPS in production

## Common Code Patterns

### Permission Check
```php
if (session()->get('role_id') != 1) {
    return redirect()->to('/')->with('error', 'Admin only');
}
```

### Model Query with Join
```php
$this->model
    ->select('table1.*, table2.name as related_name')
    ->join('table2', 'table2.id = table1.related_id', 'left')
    ->where('status', 'active')
    ->paginate(20);
```

### Form Error Check
```php
<?php if (isset($errors['fieldname'])): ?>
    <p class="text-red-400 text-sm"><?= $errors['fieldname'] ?></p>
<?php endif; ?>
```

### Redirect with Message
```php
return redirect()->to('admin/products')
    ->with('success', 'Product created successfully');
```

## Next Steps

1. Test all admin features in development
2. Set up proper email templates for notifications
3. Implement export/report functionality
4. Add user activity logging
5. Configure backup procedures
6. Set up monitoring and alerts
7. Document custom business logic
8. Train admin users
