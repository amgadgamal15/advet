# AdVet - Veterinary Medicines Quotation Website

## Project Overview
AdVet is a bilingual veterinary medicines quotation website built with plain PHP and vanilla JavaScript. The system allows customers to browse products, request quotations, and contact the company. Administrators can manage products, view quotation requests, and update company information through a secure dashboard.

## Technology Stack
- **Backend**: Plain PHP 8.3 (no framework)
- **Frontend**: Vanilla JavaScript (ES6+)
- **Data Storage**: JSON files with file locking
- **Styling**: Custom CSS with CSS variables
- **Authentication**: PHP sessions with password hashing

## Features
### Public Features
- Bilingual support (English/Arabic) with RTL layout for Arabic
- Theme modes: Light, Dark, and System auto-detect
- Product catalog with search and category filtering
- Product detail pages with full specifications and related products
- Quotation request system via modal forms
- Contact form for customer inquiries
- Responsive design for mobile, tablet, and desktop

### Admin Features
- Secure login with password hashing
- Dashboard with statistics overview
- Product management (CRUD operations)
- Quotation requests viewer
- Contact messages inbox
- Company settings and social media links editor

## Project Structure
```
/advet
├── index.php                    # Home page
├── products.php                 # Products catalog
├── product.php                  # Product detail page
├── about.php                    # About page
├── contact.php                  # Contact page
│
├── /admin                       # Admin dashboard
│   ├── index.php               # Login page
│   ├── dashboard.php           # Dashboard overview
│   ├── products.php            # Product management
│   ├── quotations.php          # Quotation requests
│   ├── messages.php            # Contact messages
│   ├── settings.php            # Company settings
│   ├── auth.php                # Authentication handler
│   └── logout.php              # Logout handler
│
├── /api                         # API endpoints
│   ├── quotation_submit.php    # Submit quotation request
│   ├── contact_submit.php      # Submit contact message
│   ├── admin_add_product.php   # Add product
│   ├── admin_edit_product.php  # Edit product
│   ├── admin_delete_product.php # Delete product
│   └── admin_update_settings.php # Update settings
│
├── /data                        # JSON data files
│   ├── products.json           # Products database
│   ├── services.json           # Services list
│   ├── quotations.json         # Quotation requests
│   ├── messages.json           # Contact messages
│   ├── settings.json           # Company settings
│   └── admin.json              # Admin credentials
│
├── /assets                      # Static assets
│   ├── /css                    # Stylesheets
│   ├── /js                     # JavaScript files
│   └── /images                 # Images and icons
│
├── /lang                        # Translation files
│   ├── en.json                 # English translations
│   └── ar.json                 # Arabic translations
│
└── /includes                    # PHP includes
    ├── header.php              # Page header
    ├── footer.php              # Page footer
    ├── navbar.php              # Navigation bar
    ├── functions.php           # Helper functions
    └── guard.php               # Auth guard
```

## Admin Credentials
- **Username**: admin
- **Password**: password

**Important**: Change these credentials in production by updating `data/admin.json` with a new bcrypt-hashed password.

## Color Palette
- **Primary**: Teal/Green (#2d7a7a)
- **Secondary**: Light Teal (#4a9d9d)
- **Accent**: Bright Teal (#66c2c2)

## Recent Changes
- [2025-10-19] Added professional stock images for all products with responsive CSS styling
- [2025-10-19] Updated product display on home, products, and detail pages to show actual images
- [2025-10-19] Added product detail page with full specifications and "More Like This" section
- [2025-10-19] Updated all product cards to link to detail page instead of direct quotation
- [2025-10-19] Added translation strings for product detail page navigation
- [2025-10-19] Initial project setup with complete bilingual system
- [2025-10-19] Implemented admin dashboard with full CRUD operations
- [2025-10-19] Added theme switching (Light/Dark/System)
- [2025-10-19] Created interactive UI effects and animations
- [2025-10-19] Configured Replit environment with PHP 8.2 and deployment settings
