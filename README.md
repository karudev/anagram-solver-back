# Anagram Solver

## Objectifs

- Développer un Service Symfony contenant l'algorithme Anagram Solver
- Exposer l'utilisation de ce Service via une route Symfony
- Tester le Service Anagram Solver ( PHPUnit )
- Créer un Endpoint API Anagram Solver permettant de servir un Front-End React.js

## Installation du projet en local
```
export APP_URL=project.local
make PROJECT_PATH=$(pwd) dev-install
````

### Enoncé

Anagram Solver

Écrivez un algorithme qui analyse 2 chaînes de caractères et vérifie si les caractères de la première chaîne peuvent être réordonnés de telle sorte qu’ils forment une deuxième chaîne.

Si la première chaîne de caractères peut vraiment être transformée dans une deuxième chaîne,déterminez le nombre minimum d’opérations de réarrangement nécessaires pour transformer la
première chaîne de caractères dans une deuxième chaîne. Un réarrangement suppose qu’uniquement 2 caractères dans des positions consécutives peuvent être inversés.

Les chaînes en cause sont représentées uniquement par des caractères alphabétiques, donc pas besoin de vérifier les majuscules, les signes diacritiques, les accents, les espaces, la ponctuation ou les
séparateurs de mots.

Input : 2 chaînes A et B.

Output : le nombre entier P représente le nombre minimum de réarrangements nécessaires pour transformer la première chaîne de caractères dans une deuxième chaîne.
Si la première chaîne de caractères ne peut pas être convertie dans une deuxième chaîne, le résultat sera -1.

Nom du test : Anagram Solver
- Langage : -
- Niveau : None
- Type de test : AlgoPlay
- Temps passé : -

Le code donné prend en entrée un fichier contenant les paramètres et renvoie les résultats comme dans le fichier de sortie.
Le résultat de sortie doit être affiché avec un caractère de retour à la ligne à la fin (cf le code donné).

Exemples :
Pour eyssaasse et essayasse => Le résultat est 3.

Itérations:
- esysaasse 1
- essyaasse 2
- essayasse 3


- Pour here et hre => Le résultat est -1.
- Pour here et here => Le résultat est 0.
- Pour here et heer => Le résultat est 1.
