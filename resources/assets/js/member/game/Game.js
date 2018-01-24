import React, {Component} from 'react';

export default class Game extends Component{
	constructor(props){
		super(props);

		this.state = {
			game: null,
			user: null
		}

		this.onClickPlayButtonHandle = this.onClickPlayButtonHandle.bind(this);
	}
	onClickPlayButtonHandle(){
		let gameId = document.getElementById('game').getAttribute('data-game-id');
		let token = localStorage.getItem("user-token");

		fetch('/api/game/'+gameId+'?token='+token, {
		})
		.then(function(response) {
			return response.json()
		}).then(function(obj) {
			this.setState({
				user: obj[0],
				game: obj[1]
			});
		}.bind(this))
		.catch(function(ex) {
			console.log('parsing failed', ex)
		});
	}
	render(){
		let {game, user} = this.state;
		return (
			<div>
				{(game)?
					<div>
						<p>{game.name}</p>
						<p><img style={{height: '350px', weight: 'auto'}} src={'/storage/'+game.image}/></p>
					</div>
					:''
				}
				{(user)?
					<div>
						<p>Your points: <b>{user.points}</b></p>
					</div>
					:''
				}
				<button onClick={this.onClickPlayButtonHandle}>Play</button>
			</div>
		);
	}
}