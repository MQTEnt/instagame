import React from 'react';

const style = {
	icon: {
		fontSize: '130%',
		color: '#b91b1b',
		padding: '0px 10px',
		cursor: 'pointer'
	}
}
export default class Image extends React.Component{
	constructor(props){
		super(props);

	}
	render(){
		let src = this.props.src;
		return(
			<div className='form-group'>
                <label>Image</label>
                <i className="fa fa-trash" style={style.icon} onClick={this.props.handleClick}></i>
                <div>
					<img src={src} style={{width: '250px', height: 'auto'}}/>
				</div>
			</div>
		);
	}
}