![http://mons.googlecode.com/svn/trunk/images/logo/mons.gif](http://mons.googlecode.com/svn/trunk/images/logo/mons.gif)

# Server General Logic #

Here is how it works.

  1. It is known that the only way to modify the gamestate is through **actions**.
  1. The server receives an **action** from HTTP. In order to identify the context of the action, each action is supplemented with a respective Game ID (can be omitted when the action is not specific-game related) and ID of the User (mandatory) issuing the action.
  1. If a game instance with the specified game id is not instantiated in the session, the server loads it from the database and puts it there.
  1. The server parses, validates and dispatches the action to the corresponding logic, mapping it to a class member function and passing it any extra parameters that were given through the request.
  1. The action-mapped function gets called by the dispatcher, returning a value of whether or not the execution of the action went smoothly.
  1. The dispatcher logs the action along with its resulting status and gives the action result back to the requester.

This model allows extensibility to cover any other turn-based game. It is apparent that there is no Monopoly-specific point anywhere in the list.


# Actions and Events #

It should be pointed out that the flow of requests and responses are asynchronous. As a response to an action the server sends only whether or not the action execution went fine, and if not fine - what the problem was. The gamestate changes are tracked by the clients separately. Each gamestate change is represented by a corresponding parameterized event. Generally the events are spawned as a result of actions, which are dictated from the client. An action may spawn no events, a single event or multiple events. A sample action of 'making a turn', for example, may spawn the following events (note that this is just a rough example):

  * moveToken(playerID, newPosition)
  * displayChance('Go back three slots and lose half of your money')
  * moveToken(playerID, newPosition - 3)
  * setBalance(playerID, playerBalance / 2)

Although the general architecture is asynchronous and the clients are updated passively, progressively re-requesting the last events and rendering them, the client initiating an action knows there may be a new event (gamestate change data) to receive when it gets a positive response for its action. Smarter clients can show a more specific approach to the protocol, knowing what to expect after every action.

Each event is tracked with an automatically incrementing unique identifier within the context of the game. Each client participating in the game can request all gamestate change events after any action ID they need. This makes it simple for the clients to load the saved games, tracking the changes from the beginning to the current state.

While the action and event requests and its parameters are fully wrapped in an HTTP URL, both the action execution status response and the event request responses are sent out as XML.