# EVolt-API
Une API REST développée pour la gestion des bornes de recharge électrique, permettant à chaque utilisateur de rechercher des bornes disponibles, de réserver un créneau de recharge et de suivre l'état de ses sessions.

## Laravel 11 (Nouvelle méthode)
Sur Laravel 11, Sanctum est souvent déjà pré-intégré mais "dormant". Tu peux activer l'API et les tables de tokens avec cette commande dédiée :

```Bash
php artisan install:api
```
Pourquoi faire ça ? Cette commande fait trois choses d'un coup :

* Elle crée le fichier routes/api.php.

* Elle publie les migrations de Sanctum.

* Elle ajoute le middleware nécessaire pour que ton application accepte les tokens.