import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faArrowLeft } from '@fortawesome/free-solid-svg-icons';

const RegistrationForm = () => {
    const [centers, setCenters] = useState([]);
    const [name, setName] = useState('');
    const [nid, setNid] = useState('');
    const [email, setEmail] = useState('');
    const [vaccineCenter, setVaccineCenter] = useState('');
    const [error, setError] = useState('');
    const [success, setSuccess] = useState(''); // Success message state

    useEffect(() => {
        // Fetch the vaccine centers from the backend
        axios.get('/api/vaccine-centers').then(response => {
            setCenters(response.data);
        }).catch(error => {
            console.error("There was an error fetching the vaccine centers!", error);
        });
    }, []);

    const validateForm = () => {
        // Name validation: Allow letters, spaces, and periods only
        const nameRegex = /^[a-zA-Z\s.]+$/;
        if (!name || !nameRegex.test(name)) {
            setError('Name should only contain letters, spaces, and periods.');
            return false;
        }

        // Validate NID (only numbers)
        if (!nid || isNaN(nid)) {
            setError('NID should contain only numbers.');
            return false;
        }

        // Validate email and vaccine center selection
        if (!email || !vaccineCenter) {
            setError('All fields are required.');
            return false;
        }

        // Clear error if all validations pass
        setError('');
        return true;
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setSuccess(''); // Clear success message before form submission
        setError('');   // Clear previous errors before form submission
    
        // Validate form before submitting
        if (!validateForm()) return;
    
        // Send the registration data to the backend
        try {
            const response = await axios.post('/api/register', {
                name,
                nid,
                email,
                vaccine_center_id: vaccineCenter,
            });
            setSuccess(response.data.message); // Set success message
            // Clear form fields after successful submission
            setName('');
            setNid('');
            setEmail('');
            setVaccineCenter('');
        } catch (error) {
            if (error.response && error.response.status === 422) {
                // If the response status is 422, show user exists message
                setError('User already exists. Try searching the Vaccination status.');
            } else {
                console.error('There was an error submitting the form:', error);
                setError('There was an error submitting the form. Please try again.');
            }
        }
    };
    

    return (
       
            
            

            <div className="max-w-lg mx-auto mt-10 p-6 bg-gray-100 rounded-md shadow-lg">
                {/* Title Section */}
                <a href="/" className="flex items-center mb-5 text-blue-500 hover:underline">
                    <FontAwesomeIcon icon={faArrowLeft} className="mr-2" />
                    Back to Home
                </a>
                <h1 className="text-3xl font-bold text-center mb-6 text-blue-600">
                    Registration
                </h1>

                {/* Success Message */}
                {success && <p className="text-green-500 text-center mb-4">{success}</p>}

                {/* Error Message */}
                {error && <p className="text-red-500 text-center mb-4">{error}</p>}

                {/* Registration Form */}
                <form onSubmit={handleSubmit} className="bg-white p-6 shadow-md rounded-md">
                    <div className="mb-4">
                        <label className="block text-gray-700 font-bold mb-2">Name:</label>
                        <input
                            type="text"
                            value={name}
                            onChange={(e) => setName(e.target.value)}
                            required
                            className="w-full p-2 border border-gray-300 rounded-md"
                        />
                    </div>
                    <div className="mb-4">
                        <label className="block text-gray-700 font-bold mb-2">NID:</label>
                        <input
                            type="text"
                            value={nid}
                            onChange={(e) => setNid(e.target.value)}
                            required
                            className="w-full p-2 border border-gray-300 rounded-md"
                        />
                    </div>
                    <div className="mb-4">
                        <label className="block text-gray-700 font-bold mb-2">Email:</label>
                        <input
                            type="email"
                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                            required
                            className="w-full p-2 border border-gray-300 rounded-md"
                        />
                    </div>
                    <div className="mb-4">
                        <label className="block text-gray-700 font-bold mb-2">Select Vaccine Center:</label>
                        <select
                            value={vaccineCenter}
                            onChange={(e) => setVaccineCenter(e.target.value)}
                            required
                            className="w-full p-2 border border-gray-300 rounded-md"
                        >
                            <option value="">Select a center</option>
                            {centers.map((center) => (
                                <option key={center.id} value={center.id}>
                                    {center.name}
                                </option>
                            ))}
                        </select>
                    </div>
                    <button
                        type="submit"
                        className="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    >
                        Register
                    </button>
                </form>
            </div>
    );
};

export default RegistrationForm;
