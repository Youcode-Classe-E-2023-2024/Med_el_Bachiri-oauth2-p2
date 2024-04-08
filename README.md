# README: Final Project - Setting up an OAuth2 Authentication System (Part 2)

This README provides detailed documentation for the final project "Setting up an OAuth2 Authentication System (Part 2)". This project aims to create a graphical interface to consume an OAuth2 authentication API.

## Project Context

The project was assigned as part of the [2023] Web and Mobile Web Developer training program. Following the development of the OAuth2 authentication API, it is now time to create a user interface to interact with this API.

## Features

The interface will include the following features:

### Authentication Interface:

- **Login**: Allows users to log in.
- **Register**: Allows new users to register.
- **Forgot Password**: Allows users to reset their password if forgotten.
- **Reset Password**: Allows users to reset their password.

### User Interface:

- **Index (Admin)**: Allows the administrator to view the list of users and ban/reintegrate them if necessary.

### Roles Interface (Admin):

- **Index**: Displays the list of roles.
- **Manage**: Allows the administrator to manage roles.
- **Assign User**: Allows the administrator to assign users to roles.

### Permissions Interface (Admin):

- **Index**: Displays the list of permissions.
- **Manage**: Allows the administrator to manage permissions.
- **Assign Role**: Allows the administrator to assign permissions to roles.

## Usage of the Project

1. **Clone the Repository**:
    ```
    git clone https://github.com/Youcode-Classe-E-2023-2024/Med_el_Bachiri-oauth2-p2
    ```

2. **Clone the API project**:
    ```
    git clone https://github.com/Youcode-Classe-E-2023-2024/Med_el_Bachiri-oauth2
    ```

3. **Serve the API project on port 8000**:
    ```
    php artisan serve --port=8000
    ```

4. **Serve this project on port 8080 (or any port you prefer)**:
    ```
    php artisan serve --port=8080
    ```

5. **Access the Application**:
- Open your web browser and go to the URL `http://localhost:8080` (the default port is usually 3000).

## Technologies Used

For frontend development, JavaScript native (using the Fetch API for consuming the API) is utilized. Laravel is used solely for routing purposes.

---

*This README provides detailed documentation for the final project "Setting up an OAuth2 Authentication System (Part 2)". For more implementation details, please refer to the documents and source code in the repository.*
