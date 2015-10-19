SELECT actors.name, COUNT(actors2movies.actorID) AS NumMovies
FROM actors, actors2movies
WHERE actors.actorID = 
(SELECT actorID
FROM actors2movies
GROUP BY actors2movies.actorID
HAVING COUNT(actors2movies.actorID) > 10)
