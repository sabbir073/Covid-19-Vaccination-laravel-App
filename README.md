
# COVID-19 Vaccination Registration System

This project is a COVID-19 Vaccination Registration system built using the following technologies:

- **PHP**: 8.3.9
- **Laravel**: 11.x
- **Node.js**: 22.9.0
- **NPM**: 10.8.1
- **React.js**: 18.x
- **Vite**: 4.x
- **MySQL**: 8.x
- **Axios**: HTTP Client for API Requests
- **Tailwind CSS**: For responsive and modern styling
- **FontAwesome**: For icons

## Getting Started

### Prerequisites

To run this project locally, you will need the following:

- **PHP** (version 8.3.9 or higher)
- **Composer** (version 2.7.7 or higher)
- **Node.js** (version 22.9.0 or higher)
- **NPM** (version 10.8.1 or higher)
- **MySQL** (or any other database you prefer)

### Clone the Repository

Clone the repository from GitHub and navigate into the project folder:

```bash
git clone https://github.com/sabbir073/Covid-19-Vaccination-laravel-App.git
cd Covid-19-Vaccination-laravel-App
```

### Installing Dependencies

Install the necessary PHP dependencies using Composer:

```bash
composer install
```

Install the necessary Node.js dependencies:

```bash
npm install
```

### Setting up the Environment

Open the `.env` file in a text editor and update the following variables to connect to your MySQL database:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

Configure the email settings to send email notifications:

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=your_email_username
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@example.com
MAIL_FROM_NAME="Vaccination System"
```

### Database Migration and Seeding

After setting up the environment, run the following commands to create and seed the database:

1. **Run migrations** to create the necessary tables:

```bash
php artisan migrate
```
If you see any errors in migration, run this command

```bash
php artisan migrate:fresh
```

2. **Seed the database** with vaccine centers:

```bash
php artisan db:seed
```

### Running the Application

To run the backend and frontend, you need to start both services:

1. Start the backend server:

```bash
php artisan serve
```

2. Run the frontend (React) using Vite:

```bash
npm run dev
```

You can now access the application by visiting [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser.

### Application Features

1. **User Registration**: Users can register for a COVID-19 vaccination, selecting a vaccine center at the time of registration. Duplicate registrations are not allowed based on NID and Email.
2. **Vaccination Scheduling**: The system automatically schedules users based on a "first-come, first-served" strategy while considering each center's daily limit. and also consider a buffer time at least one day.
3. **Search Vaccination Status**: Users can check their vaccination status using their NID. The statuses can be:
   - `Not registered`
   - `Not scheduled`
   - `Scheduled`
   - `Vaccinated`
and if a user's vaccinated date is over, the app will automatically change the status as vaccinated.

4. **Email Notifications**: Users receive a notification email at 9 PM the night before their vaccination date.
5. **Performance Optimizations**: Optimized database queries and indexed key fields (like NID) for fast lookups during search and registration.

### Additional Considerations for Future Requirements

If there is an additional requirement to send SMS notifications along with the email, the following changes need to be made:

1. Integrate an SMS service such as Twilio, Nexmo, or another API provider.
2. Update the `sendVaccinationEmail` method in the `ScheduleVaccination` command to also include sending SMS.
3. Add the necessary configuration details for the SMS service in the `.env` file (e.g., Twilio credentials).
4. Modify the notification logic to handle both email and SMS.

### Performance Notes

If additional optimization were required, the following strategies would be considered:

1. **Database Indexing**: Index fields like `nid`, `vaccine_center_id`, and `scheduled_date` to optimize search and scheduling operations.
2. **Caching**: Implement caching for vaccine center data and search results to reduce database load.
3. **Job Queues**: Use Laravel's job queue for email notifications to avoid delays in the user registration process.

### Steps Followed to Complete the Task Requirements

1. Created a **registration page** where users can register for vaccination, with the ability to select a vaccine center.
2. Ensured that every **vaccine center has a daily limit** and users are scheduled based on the **first-come, first-served** basis.
3. Built logic to schedule users only on **weekdays (Sunday to Thursday)** and send **notification emails** the night before their scheduled vaccination date.
4. Developed a **search page** where users can enter their NID to check their vaccination status. Handled cases where:
   - Users are not registered.
   - Users are registered but not yet scheduled.
   - Users are scheduled with a date.
   - Users are vaccinated if the scheduled date has passed.
5. **Prevented duplicate registration** by enforcing unique NID registration.


### Copyright - MD Sabbir Ahmed