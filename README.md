## Initialiser le projet
Requis:
1. docker
2. docker-compose
3. make

Lancer la commande

```make install && sleep 30 && make create-db```

Cela va build les container docker, y installer les dépendances et initialiser la base de données
Le projet sera accessible sur le port 8888 -> http://localhost:8888/

### Désinstaller
Pour couper/supprimer les container et supprimer les dependances lancer
```make uninstall```

# TEST

Ceci est le repository pour le test technique de Farmitoo.

## Le cas

L'objectif est d'afficher une page "panier" sur laquelle sont visibles :
- tous les produits avec titre, prix unitaire, marque et quantité
- sous-total HT
- promotion (le cas échéant)
- frais de port HT
- total HT
- TVA
- Total TTC
- un bouton pour aller sur la page de paiement

#### Info TVA
Le business modèle de Farmitoo implique des règles de calculs de la TVA complexes.
Dans notre cas, il est simplifié et le taux de TVA dépend seulement de la marque du produit :
- Farmitoo => 20%
- Gallagher => 5%

#### Info frais de port
Les partenaires de Farmitoo ont des règles de calculs de frais de port très différentes. 
Voici celles de notre cas :
- Farmitoo : 20€ par tranche de 3 produits entamée (ex: 20€ pour 3 produits et 40€ pour 4 produits)
- Gallagher : 15€ quelque soit le nombre de produits

## L'évaluation
Il faut penser ton code comme évolutif :
- ajout de 10 nouvelles marques avec des nouvelles règles de calculs de TVA et de calculs de frais de port
- prise en compte du pays dans le calcul de la TVA
- nouvelles conditions d'application des promotions (nombre de produits, date, nombre d'utilisation...)

Au niveau global, sera évalué :
- la qualité du code
- la rigueur

#### Front
- L'UX
- L'organisation du code

#### Back
- Les choix de conception
- L'organisation du code

#### Test
L'objectif n'est pas un code coverage de 100% ! 
Mais un choix judicieux des choses à tester.
