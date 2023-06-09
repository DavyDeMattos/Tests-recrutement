# Test SQL

Vous avez 4 tables :

- auteur (id, nom)
- livre (id, titre, #auteur_id)
- magasin (id, nom, ville)
- vente (#livre_id, #magasin_id, qte_vendu)
  
## Vous devez réaliser les requêtes suivantes :

1- Écrire la requête SQL permettant de récupérer tous les auteurs commençant par V

```sql
SELECT * FROM `auteur` WHERE `nom` LIKE 'V%'
```

2- Écrire la requête SQL permettant de récupérer tous les livres de Victor Hugo, trié par ordre alphabétique

```sql
SELECT * FROM `livre`
INNER JOIN `auteur` ON `livre`.`auteur_id` = `auteur`.`id`
WHERE `auteur`.`nom` = 'Victor Hugo' ORDER BY `livre`.`titre`ASC
```

3- Écrire la requête SQL permettant de connaître les magasins ayant vendu au moins 1200 livres

```sql
SELECT `magasin`.`nom`, SUM(`qte_vendu`) AS `qte_total` 
FROM `vente`
INNER JOIN `magasin` ON `vente`.`magasin_id` = `magasin`.`id`
GROUP BY `magasin`.`nom`
HAVING SUM(`qte_vendu`)>1200
```

4- Écrire la requête SQL permettant de connaître les 5 auteurs ayant vendu le plus, avec comme données, le nom de l’auteur et le nombre total de ventes

```sql
SELECT `auteur`.`nom`, SUM(`qte_vendu`) AS `qte_total`
FROM `vente`
INNER JOIN `magasin` ON `vente`.`magasin_id` = `magasin`.`id`
INNER JOIN `livre` ON `vente`.`livre_id` = `livre`.`id`
INNER JOIN `auteur` ON `livre`.`auteur_id` = `auteur`.`id`
GROUP BY `auteur`.`nom`
ORDER BY `qte_total` DESC
LIMIT 5
```

5- Ecrire la requête SQL permettant de récupérer pour chaque magasin, l'auteur qui a vendu le plus de livre et le nombre de vente correspondant

```sql
SELECT `magasin`.`nom`,`auteur`.`nom`, `vente`.`qte_vendu`, (SELECT COUNT(`magasin`.`nom`) FROM `magasin`) AS `magasin_count`
FROM `vente`
INNER JOIN `magasin` ON `vente`.`magasin_id` = `magasin`.`id`
INNER JOIN `livre` ON `vente`.`livre_id` = `livre`.`id`
INNER JOIN `auteur` ON `livre`.`auteur_id` = `auteur`.`id`
GROUP BY `auteur`.`nom`
ORDER BY `qte_vendu` DESC
-- LIMIT (COUNT(`magasin`.`nom`) FROM `magasin`)
```

*Le `LIMIT` ne fonctionne pas et je n'arrivve pas à trouver comment régler la requête SQL sans variable*

6- Écrire la requête permettant de remonter les magasins vendant "Les Misérables" plus que la moyenne de vente de ce livre de tous les magasins

<!-- Use AVG
Faire deux sélections ? -->