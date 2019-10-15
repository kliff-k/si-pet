const functions = require('firebase-functions');
const express = require('express');

const app = express();

app.get('/home', (request, response) =>
{
 response.send('fuck yeah');
});

exports.app = functions.https.onRequest(app);