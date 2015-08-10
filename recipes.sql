SELECT r.title, a.name AS von
FROM recipe r, author a, recipeauthors ra
WHERE ra.recipe = r.id AND ra.author = a.id;
