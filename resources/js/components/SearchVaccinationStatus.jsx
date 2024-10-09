import React, { useState } from 'react';
import axios from 'axios';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faArrowLeft } from '@fortawesome/free-solid-svg-icons';

const SearchVaccinationStatus = () => {
    const [nid, setNid] = useState('');
    const [status, setStatus] = useState('');
    const [scheduledDate, setScheduledDate] = useState('');
    const [error, setError] = useState('');

    const validateNID = () => {
        // Ensure the NID contains only numbers
        const nidRegex = /^[0-9]+$/;
        if (!nidRegex.test(nid)) {
            setError('NID should contain only numbers.');
            return false;
        }
        return true;
    };

    const handleSearch = async (e) => {
        e.preventDefault();
        setStatus(''); // Reset status on new search
        setScheduledDate(''); // Reset scheduled date on new search
        setError(''); // Clear error

        // Validate NID input
        if (!validateNID()) return;

        try {
            const response = await axios.post('/api/search', { nid });
            const { status, scheduled_date } = response.data;
            setStatus(status);

            // If status is "Scheduled" or "Vaccinated", show the date
            if (status === 'Scheduled' || status === 'Vaccinated') {
                setScheduledDate(scheduled_date);
            } else {
                setScheduledDate(''); // Clear scheduledDate if not applicable
            }
        } catch (error) {
            if (error.response && error.response.status === 404) {
                setStatus('Not registered');
            } else {
                setError('Something went wrong. Please try again later.');
            }
        }
    };

    return (
        <div className="max-w-lg mx-auto mt-10 p-6 bg-white shadow-md rounded-md">
            <a href="/" className="flex items-center mb-5 text-blue-500 hover:underline">
                    <FontAwesomeIcon icon={faArrowLeft} className="mr-2" />
                    Back to Home
                </a>
            <h1 className="text-2xl font-bold text-center mb-6">Check Vaccination Status</h1>

            <form onSubmit={handleSearch} className="mb-4">
                <div className="mb-4">
                    <label className="block text-gray-700 font-bold mb-2">Enter NID:</label>
                    <input
                        type="text"
                        value={nid}
                        onChange={(e) => setNid(e.target.value)}
                        required
                        className="w-full p-2 border border-gray-300 rounded-md"
                    />
                </div>
                <button
                    type="submit"
                    className="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Search
                </button>
            </form>

            {status && (
                <div className="mt-4">
                    {status === 'Not registered' ? (
                        <div>
                            <p>Status: <strong>{status}</strong></p>
                            <a href="/registration" className="text-blue-500">Register for vaccination</a>
                        </div>
                    ) : (
                        <div>
                            <p>Status: <strong>{status}</strong></p>
                            {scheduledDate && (
                                <p className={`Scheduled Date: ${status === 'Vaccinated' ? 'text-red-500' : 'text-black'}`}>
                                    Scheduled Date: <strong>{scheduledDate}</strong>
                                </p>
                            )}
                        </div>
                    )}
                </div>
            )}

            {error && <p className="text-red-500">{error}</p>}
        </div>
    );
};

export default SearchVaccinationStatus;
