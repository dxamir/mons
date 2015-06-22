# Introduction #

This paper described the details involved with the server actions.


# Performing Actions #

## Action Request ##
Each action request should be supplemented with the following parameters:

  * `$action` - Action name
  * `$uid` - ID of the user performing the action
  * `$gid` - ID of the game in which context the action should be performed, if available
  * `$param` - an associative array of (name => value) pairs to be passed to the action function

## Action Response ##
Each action gets a mandatory XML response with action execution status and optional message. Sample response:

```
<ActionResponse status="0">
	<message type="0">Chat message sent successfully.</message>
</ActionResponse>
```

Response status attribute can have one of the following values (bold signifies the default value if the attribute is ommitted):

| **Status** | **Description** |
|:-----------|:----------------|
| **0**      | Success         |
| 1          | Error           |

Message type attribute can be any of the following:

| **Type** | **Description** |
|:---------|:----------------|
| **0**    | Notice          |
| 1        | Error           |
| 2        | Warning         |


---


# Action Types #

## tell ##
Sends the specified message to the chat.

#### Result ####
a **chat** event is registered for the respective player(s) with the given message.

#### Parameters ####
| **Name** | **Description** |
|:---------|:----------------|
|`message` |Text of the message to send|
|`to`      |User ID to receive the message, omit for sending the message to the current room of the sender|

## turn ##
Makes a turn