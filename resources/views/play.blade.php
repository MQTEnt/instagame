<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Play a game</title>
	<style>
		div{
			text-align: center;
		}
	</style>
</head>
<body>
	<div id="header">
		<h1>Play game {{$game->name}}</h1>
	</div>
	<div id="content">
		<p>Click PLAY to get the result</p>
		<div id="game" data-game-id="{{$game->id}}">
		</div>
	</div>
	<script src="/js/member/game/index.js"></script>
</body>
</html>