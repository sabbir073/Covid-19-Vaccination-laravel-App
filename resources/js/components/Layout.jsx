// resources/js/components/Layout.jsx

import React from 'react';

const Layout = ({ children }) => {
    return (
        <div className="flex flex-col min-h-screen">
            <main className="flex-grow">{children}</main>
            <footer className="bg-gray-800 text-white py-4 text-center">
                <p>© 2024 COVID-19 Vaccination System. All rights reserved.</p>
            </footer>
        </div>
    );
};

export default Layout;
