# Santana Motor PWA

## Overview
Santana Motor is a Progressive Web App (PWA) that provides users with an engaging experience for browsing and purchasing motorcycles. This project includes features such as offline access, push notifications, and a responsive design.

## Project Structure
The project is organized as follows:

```
santana-motor
├── app
│   ├── Controllers
│   │   └── Pwa.php          # Handles PWA logic
│   └── Views
│       ├── layouts
│       │   └── landing.php  # Layout template for landing page
│       └── landing
│           └── index.php    # Main landing page view
├── public
│   ├── .htaccess            # URL rewriting and server configuration
│   ├── manifest.webmanifest  # PWA manifest file
│   ├── service-worker.js     # Service worker for offline capabilities
│   └── assets
│       ├── css
│       │   └── pwa.css      # PWA-specific CSS styles
│       └── js
│           └── pwa.js       # JavaScript for PWA functionality
├── writable
│   └── cache                 # Directory for caching assets
├── composer.json             # Composer dependencies
└── README.md                 # Project documentation
```

## Features
- **Offline Access**: Users can access the app even without an internet connection.
- **Push Notifications**: Engage users with timely updates and offers.
- **Responsive Design**: The app is designed to work seamlessly on various devices.

## Installation
1. Clone the repository:
   ```
   git clone <repository-url>
   ```
2. Navigate to the project directory:
   ```
   cd santana-motor
   ```
3. Install dependencies using Composer:
   ```
   composer install
   ```
4. Set up your web server to point to the `public` directory.

## Usage
- Access the app through your web browser at the configured URL.
- Install the PWA on your device for a native app experience.

## Contributing
Contributions are welcome! Please submit a pull request or open an issue for any enhancements or bug fixes.

## License
This project is licensed under the MIT License. See the LICENSE file for more details.