// resources/js/components/Welcome.jsx

import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faUser, faSearch } from '@fortawesome/free-solid-svg-icons';

const Welcome = () => {
    return (
        <div className="flex flex-col justify-between items-center bg-gray-100 text-center">
            {/* Title */}
            <div className="flex-grow mt-10">
                <h1 className="text-4xl font-bold text-blue-600">Welcome to Covid19 Vaccination System</h1>
            </div>

            {/* Grid section with two boxes */}
            <div className="grid grid-cols-2 gap-8 mt-28 mb-24">
                {/* Registration Box */}
                <a href="/registration" className="flex flex-col items-center p-6 bg-white shadow-lg rounded-lg hover:bg-blue-100 transition duration-300 transform hover:scale-105">
                    <FontAwesomeIcon icon={faUser} className="text-blue-600 w-20 h-20 mb-4" />
                    <span className="text-xl font-semibold text-gray-700">Registration</span>
                </a>

                {/* Track Status Box */}
                <a href="/search" className="flex flex-col items-center p-6 bg-white shadow-lg rounded-lg hover:bg-blue-100 transition duration-300 transform hover:scale-105">
                    <FontAwesomeIcon icon={faSearch} className="text-blue-600 w-20 h-20 mb-4" />
                    <span className="text-xl font-semibold text-gray-700">Track Status</span>
                </a>
            </div>
        </div>
    );
};

export default Welcome;
