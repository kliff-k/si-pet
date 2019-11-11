const functions = require('firebase-functions');
const express = require('express');
const header = require('./src/html/header');
const footer = require('./src/html/footer');
const app = express();

app.get('/home', (request, response) => {
        const home = require('./src/html/home');
        const body = header.header.replace('{title}','SI PET')+home.home+footer.footer;
        response.status(200).send(body);
});

app.get('/alimentacao', (request, response) => {
        const alimentacao = require('./src/html/alimentacao');
        const body = header.header.replace('{title}','ALIMENTAÇÃO')+alimentacao.alimentacao+footer.footer;
        response.status(200).send(body);
});

app.get('/galeria', (request, response) => {
        const galeria = require('./src/html/galeria');
        const body = header.header.replace('{title}','GALERIA')+galeria.galeria+footer.footer;
        response.status(200).send(body);
});

app.get('/historico', (request, response) => {
        const historico = require('./src/html/historico');
        const body = header.header.replace('{title}','HISTÓRICO')+historico.historico+footer.footer;
        response.status(200).send(body);
});

app.get('/historico', (request, response) => {
        const historico = require('./src/html/historico');
        const body = header.header.replace('{title}','HISTÓRICO')+historico.historico+footer.footer;
        response.status(200).send(body);
});

exports.app = functions.https.onRequest(app);