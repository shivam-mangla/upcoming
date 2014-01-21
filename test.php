<?php

echo "test has started";
error_reporting(-1);

require("phar://neo4jphp.phar");

use Everyman\Neo4j\Client,
    Everyman\Neo4j\Transport,
    Everyman\Neo4j\Node,
    Everyman\Neo4j\Relationship;

$client = new Client(new Transport('localhost', 7474));

echo "setup connection";

// Now we need to create a node for each of our actors and movies. This is analogous to the INSERT statements used to enter data into a traditional RDBMS:

$keanu = new Node($client);
$keanu->setProperty('name', 'Keanu Reeves')->save();
$laurence = new Node($client);
$laurence->setProperty('name', 'Laurence Fishburne')->save();
$jennifer = new Node($client);
$jennifer->setProperty('name', 'Jennifer Connelly')->save();
$kevin = new Node($client);
$kevin->setProperty('name', 'Kevin Bacon')->save();

$matrix = new Node($client);
$matrix->setProperty('title', 'The Matrix')->save();
$higherLearning = new Node($client);
$higherLearning->setProperty('title', 'Higher Learning')->save();
$mysticRiver = new Node($client);
$mysticRiver->setProperty('title', 'Mystic River')->save();

// Each node has `setProperty` and `getProperty` methods that allow storing arbitrary data on the node. No server communication happens until the `save()` call, which must be called for each node.

// Linking an actor to a movie means setting up a relationship between them. In RDBMS terms, the relationship takes the place of a join table or a foreign key column. In the example, the relationship always starts with the actor pointing to the movie, and is tagged as an "acted in" type relationship:

$keanu->relateTo($matrix, 'IN')->save();
$laurence->relateTo($matrix, 'IN')->save();

$laurence->relateTo($higherLearning, 'IN')->save();
$jennifer->relateTo($higherLearning, 'IN')->save();

$laurence->relateTo($mysticRiver, 'IN')->save();
$kevin->relateTo($mysticRiver, 'IN')->save();

echo "It should save many";

// The `relateTo` call returns a Relationship object, which is like a node in that it can have arbitrary properties stored on it. Each relationship is also saved to the database.

// The direction of the relationship is totally arbitrary; paths can be found regardless of which direction a relationship points. You can use whichever semantics make sense for your problem domain. In the example above, it makes sense that an actor is "in" a movie, but it could just as easily be phrased that a movie "has" an actor. The same two nodes can have multiple relationships to each other, with different directions, types and properties.

// The relationships are all set up, and now we are ready to find links between any actor in our system and Kevin Bacon. Note that the maximum length of the path is going to be 12 (6 degrees of separation multiplied by 2 nodes for each degree; an actor node and a movie node.)

$path = $keanu->findPathsTo($kevin)
    ->setMaxDepth(12)
    ->getSinglePath();

foreach ($path as $i => $node) {
    if ($i % 2 == 0) {
        echo $node->getProperty('name');
        if ($i+1 != count($path)) {
            echo " was in\n";
        }
    } else {
        echo "\t" . $node->getProperty('title') . " with\n";
    }
}

// A path is an ordered array of nodes. The nodes alternate between being actor and movie nodes.

// You can also do the typical "find all the related movies" type queries:

echo $laurence->getProperty('name') . " was in:\n";
$relationships = $laurence->getRelationships('IN');
foreach ($relationships as $relationship) {
    $movie = $relationship->getEndNode();
    echo "\t" . $movie->getProperty('title') . "\n";
}

?>
