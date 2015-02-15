Programming Test: Battle ships

You must write the game as a simple application with web and console user interfaces using shared game logic.
Should create a index.php file which loads (requires) the appropriate controller and logic.

The Problem

Implement a simple game of battleships
http://en.wikipedia.org/wiki/Battleship (game)

You must create a simple application to allow a single human player to play a one-sided game
of battleships against the computer.

The program should create a 10x10 grid, and place a number of ships on the grid at random
with the following sizes:

1 x Battleship (5 squares)
2 x Destroyers (4 squares)

Ships can touch but they must not overlap.
The application should accept input from the user in the format "A5" to signify a square
to target, and feedback to the user whether the shot was success, miss, and additionally
report on the sinking
of any vessels.
. = no shot
- = miss
X = hit
