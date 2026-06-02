# 🏆 Community_Quiz in Laravel Livewire
A dynamic, full-stack Quiz application built with Laravel and Livewire. This platform allows users to create accounts, play quizzes, climb the global leaderboard, and even create their own questions or report errors via a built-in ticketing system.

## ✨ Features
- User Authentication: Secure login and registration using modern UI components.

- Interactive Quiz Engine: Real-time quiz playing experience powered by Livewire (no page reloads).

- Dynamic Leaderboard: A top 10 ranking system updated in real-time based on user scores.

- Content Management: Users and Admins can create custom questions with multiple-choice answers.

- Ticketing System: Built-in error reporting allowing users to flag incorrect questions directly to admins.

- Dark Mode: Fully responsive and accessible UI with native dark mode support.

## 🛠️ Tech Stack
- Backend: Laravel 11, PHP 8.2+

- Frontend: Livewire 3, Tailwind CSS, Flux UI Components

- Database: MySQL / SQLite

- Testing: PHPUnit / Pest (Feature & Unit Tests)

## 🚀 Setup Instructions
Follow these steps to get the project up and running on your local machine.

### 1. Clone the repository

<pre>
git clone https://github.com/your-username/your-repo-name.git
cd your-repo-name
</pre>

### 2. Install Dependencies
Install the PHP and Node.js dependencies:

<pre>
composer install
npm install
npm run build
</pre>

### 3. Environment Configuration
Copy the example environment file and generate your application key:

<pre>
cp .env.example .env
php artisan key:generate
</pre>
Note: Make sure to configure your database settings (DB_CONNECTION, DB_DATABASE, etc.) in the .env file. For a quick local setup, you can set DB_CONNECTION=sqlite.

  
### 4. Run Migrations and Seeders
Create the database tables and populate them with initial data (users, dummy questions, and answers):

<pre>
php artisan migrate --seed
</pre>

### 5. Start the Application
Boot up the local development server:

<pre>
php artisan serve
</pre>

You can now access the application at http://localhost:8000.

## 🏗️ Design Decisions & Architecture
To ensure the application remains scalable, maintainable, and easy to test, several architectural decisions were made during development.

### 1. Service Pattern (QuestionService)
Instead of cluttering Livewire components or Controllers with complex database logic, business logic was extracted into dedicated Service classes (e.g., QuestionService).

Why? This keeps components "thin" (only handling UI state and user input) while the Service handles the heavy lifting of saving questions, attaching correct/incorrect answers, and ensuring data integrity.

### 2. Repository Pattern (ScoreRepository)
Data retrieval logic, especially for the Leaderboard, is abstracted into a Repository.

Why? Fetching the top 10 best scores requires specific ordering and limits. By placing this in ScoreRepository::bestScores(), the code becomes reusable across different parts of the app (Dashboard, API, widgets) without duplicating Eloquent queries.

### 3. Robust Testing Strategy (AAA Pattern)
The project includes a comprehensive test suite using the Arrange-Act-Assert (AAA) methodology.

Why? Testing features like score calculation (GenerateQuiz) and question creation are critical. I utilized Laravel's RefreshDatabase trait and Factory states (->has()) to simulate database records and ensure that regressions do not occur when new features are added.

### 4. UI Consistency with Flux UI & Tailwind
I utilized Flux UI alongside Tailwind CSS for authentication views and dashboard layouts.

Why? It provides accessible, unstyled, and highly customizable blade components out of the box. This allowed us to quickly build a polished, gamified interface (with custom SVG icons, gradients, and Dark Mode) while keeping the HTML semantic and clean.
