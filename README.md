# Product Feedback Tool

## Overview

The Product Feedback Tool is a web-based application that facilitates user engagement and feedback submission for product improvement. This tool allows users to submit feedback, view existing feedback, vote on suggestions, and interact with other users through comments.

## Features

- **User Authentication and Authorization**
  - Users can register, log in, and log out.
  - Only authenticated users can submit feedback and vote on existing feedback.
  - An admin user is provided with the following credentials:
    - **Username**: admin@mail.com
    - **Password**: admin

- **Feedback Submission**
  - Users can submit feedback with a title, description, and category (e.g., bug report, feature request, improvement).

- **Feedback Listing**
  - Feedback items are displayed in a paginated list.
  - Each feedback item includes its title, category, vote count, and the user who submitted it.

- **Commenting System**
  - Users can leave comments on feedback items.
  - Comments include the user's name, date, and content.
  - Basic formatting options (e.g., bold, italic, code blocks) are available for comments.

- **Admin Panel**
  - Admins have access to an admin panel with appropriate authentication.
  - Admins can manage users, feedback items, and enable/disable comments.

- **Advanced Commenting Features**
  - Users can mention other users in comments using the "@" symbol.
  - Rich text editing options are available for comments.
  - Emoji support is implemented in comments.

## Getting Started

### Prerequisites

Before you begin, make sure you have the following tools and software installed:

- PHP (recommended version)
- Composer (https://getcomposer.org/)
- Node.js (https://nodejs.org/)
- npm (Node Package Manager)
- MySQL or your preferred database system
- Laravel CLI (https://laravel.com/docs/10.x/installation)

### Installation

Follow these steps to set up the project on your local machine:

Clone this repository to your local machine:

   ```bash
   git clone https://github.com/muazmunir/feedback-tool.git
   cd feedback-tool
   cp .env.example .env
   composer install
   php artisan key:generate
   npm install
   npm run dev
   php artisan migrate
   php artisan db:seed
   php artisan serve
