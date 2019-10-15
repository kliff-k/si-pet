const functions = require('firebase-functions');
const express = require('express');
const fs = require('fs');

const app = express();

app.get('/home', (request, response) =>
{
 fs.readFile('../public/index.html',(err,data) =>
 {
  if (err) throw err;
  response.send(data,'html');
 });
});

exports.app = functions.https.onRequest(app);