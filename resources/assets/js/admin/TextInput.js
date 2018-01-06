import React from 'react';

export default class TextInput extends React.Component{
	constructor(props){
		super(props);

		this.onChangeHandle = this.onChangeHandle.bind(this)
		this.state = {
			value: ''
		}
	}
	onChangeHandle(value){
        this.setState({
            value: value
        });
    }
    componentDidUpdate(prevProps, prevState){
    	if (prevProps.value !== this.props.value) {
		    this.setState({value: this.props.value});
		 }
    }
	render(){
		let {name, label, placeholder, errorText, value} = {...this.props}
		return(
			<div className={(!errorText)?'form-group':'form-group has-error'}>
				<label>{label}</label>
				<input 	id={name}
						type="text" 
						className="form-control" 
						name={name}
						placeholder={placeholder}
						onBlur={(e)=>this.props.onBlurHandle(e.target.value)}
						value={this.state.value}
						onChange={e => this.onChangeHandle(e.target.value)}
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