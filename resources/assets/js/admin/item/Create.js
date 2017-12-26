import React from 'react';

export default class Create extends React.Component{
	constructor(props){
		super(props);

	}
	render(){
		return(
			<div className="box box-primary">
				<div className="box-body">
					<div className="form-group">
						<label>Name</label>
						<input 	id="name" 
								type="text" 
								className="form-control" 
								name="name" 
								value=""
								placeholder="Tag name"/>
						<span className="help-block">
							<strong></strong>
						</span>
					</div>

					<div className="form-group">
						<label>Description</label>
						<textarea	
							id="desc" 
							className="form-control" 
							name="desc" 
							placeholder="Tag description"></textarea>
						<span className="help-block">
							<strong></strong>
						</span>
					</div>
					
				</div>
				<div className="box-footer">
					<button type="submit" className="btn btn-primary"><i className="fa fa-share" aria-hidden="true"></i> Create</button>
				</div>
			</div>
		);
	}
}