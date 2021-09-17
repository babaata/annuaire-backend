# Comment contributer a ce projet

1. Forker le projet
2. Clone le projet forke
3. Ajouter le référentiel du projet en tant 'upstream' remote
```sh
git remote add upstream `https://github.com/babaata/annuaire-frontend.git`
```
4. Verifier les remotes URL
```sh
git remote -v
```
5. Ajouter le dernier changement
```sh
git pull upstream main
```
6. Creer une branch dev
```sh
git checkout -b dev
```
7. Ajouter vos changements et faites un commit
8. Envoyer vos changements
```sh
git push origin dev
```
9. Creer un pull request et valider
12. Synchroniser les changements
```sh
git pull upstream main
```
