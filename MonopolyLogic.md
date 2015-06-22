# Introduction #

This class is the sole responsible for the entire Monopoly game logic. Being used by the Command Dispatcher, this class is responsible for making gamestate changes to the Monopoly games, handling turns, rolling dice, issuing random Chances and everything else that occur during a Monopoly game in terms of the game logic itself.

Philosophically, an instance of this class represents a single game with its board and players. It is therefore instantiated each time a game goes live.

# Gamestate #

The class stores the following data for the gamestate:

  * All 40 slots of the board (class `Slot`).
  * All players playing on the board (class `MonopolyPlayer`). This class includes money balance, properties, token and more, and is generated from the class Player.
  * Player who has the current turn.

# Starting a game #

The game is generally started by calling the overridden `Game::start()` function. In `MonopolyGame`, this function does the following:

  * Initializes the slots
  * Initializes the players with their starting balance and properties (or absence of those).
  * Randomly determines the player to make the first turn.
  * Brings the game to a regular 'next turn' state to be fetched during the next request by all players.