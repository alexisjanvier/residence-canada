import React from 'react';
import { fetchUtils, Admin } from 'react-admin';

import dataProvider from './dataProvider';

const httpClient = (url, options = {}) => {
    if (!options.headers) {
        options.headers = new Headers({ Accept: 'application/json' });
    }
    options.headers.set('X-Roles', 'AFED_ADMIN');
    const token = localStorage.getItem('token');
    if (token) {
        options.headers.set('Authorization', `Bearer ${token}`);
    }
    return fetchUtils.fetchJson(url, options);
};

const apiProvider = dataProvider('/api/', httpClient);

const App = () => (
    <Admin dataProvider={apiProvider} title="Residence Canada" />
);

export default App;
