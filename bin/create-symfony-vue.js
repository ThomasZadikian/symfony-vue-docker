#!/usr/bin/env node

const degit = require('degit');

const emitter = degit('ThomasZadikian/symfony-vue-project', {
  cache: false,
  force: true,
  verbose: true
});

emitter.clone(process.cwd())
  .then(() => {
    console.log('Importation du scaffold réussi ! Note : Ceci est un scaffold configuré pour une utilisation en dev. Veuillez vous assurer de le configurer pour la production avant de l\'utiliser en production.');
  })
  .catch((err) => {
    console.error('Erreur lors de l\'importation du squelette :', err);
  });
