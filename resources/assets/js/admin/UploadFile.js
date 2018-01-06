import React from 'react';

export default class UploadFile extends React.Component{
	constructor(props){
		super(props);

		this.state = {
			file: null,
			srcFile: null
		}
		this.onChange = this.onChange.bind(this);
	}
	onChange(e){
		this.props.onChangeHandle(e);

		let file = e.target.files[0];
		if(file){
			this.setState({file});
	        let reader = new FileReader();
	        reader.onloadend = function() {
	            this.setState({srcFile: reader.result})
	        }.bind(this);
	        reader.readAsDataURL(file);
	    }
	}
	render(){
		let {name, label, errorText} = {...this.props}
		let file = this.state.file;
		let srcFile = this.state.srcFile;
		let style = {
			image: {
				width: '250px',
				height: 'auto'
			},
			div: {
				margin: '20px 0px'
			}
		}
		return(
			<div className={(!errorText)?'form-group':'form-group has-error'}>
                <label>{label}</label>
		    	<input name={name} type="file" onChange={this.onChange}/>
		    	{(file)? 
		    		<div style={style.div}>
			    		<img style={style.image} src={srcFile} name='imageView' alt="image" />
		    		</div>
		    		:''
		    	}
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