import React from 'react';

export default class TextInput extends React.Component{
	constructor(props){
		super(props);

	}
	render(){
		let {name, label, placeholder, errorText} = {...this.props}
		return(
			<div className={(!errorText)?'form-group':'form-group has-error'}>
				<label>{label}</label>
				<input 	id={name}
						type="text" 
						className="form-control" 
						name={name}
						placeholder={placeholder}
						onBlur={(e)=>this.props.onBlurHandle(e.target.value)}
				/>
				{(errorText)?
					<span className="help-block">
						<strong>
							{errorText}
						</strong>
					</span>
					:''
				}
			</div>
		);
	}
}