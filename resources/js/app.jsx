// resources/js/app.jsx

import React from 'react';
import { createRoot } from 'react-dom/client';
import '../css/app.css'; // Ensure styles are loaded

// Import components
import RegistrationForm from './components/RegistrationForm';
import SearchVaccinationStatus from './components/SearchVaccinationStatus';
import Welcome from './components/Welcome';
import Layout from './components/Layout';  // Import Layout

// Find the DOM element to attach React to
const rootElement = document.getElementById('app');

// Determine the current path to conditionally render the correct component
const currentPath = window.location.pathname;

if (rootElement) {
    const root = createRoot(rootElement);

    // Conditionally render based on URL path, with Layout wrapper
    if (currentPath === '/search') {
        root.render(
            <Layout>
                <SearchVaccinationStatus />
            </Layout>
        );
    } else if (currentPath === '/registration') {
        root.render(
            <Layout>
                <RegistrationForm />
            </Layout>
        );
    } else if (currentPath === '/') {
        root.render(
            <Layout>
                <Welcome />
            </Layout>
        );
    } else {
        root.render(
            <Layout>
                <h1>404 - Page Not Found</h1>
            </Layout>
        );
    }
}
