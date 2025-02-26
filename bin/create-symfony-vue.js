#!/usr/bin/env node

const degit = require('degit');

const emitter = degit('ThomasZadikian/symfony-vue-project', {
  cache: false,
  force: true,
  verbose: true
});

emitter.clone(process.cwd())
  .then(() => {
    console.log('Squelette importé avec succès !');
  })
  .catch((err) => {
    console.error('Erreur lors de l\'importation du squelette :', err);
  });
