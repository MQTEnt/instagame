import React from 'react';

import ReactAutocomplete from 'react-autocomplete';

export default class SearchBox extends React.Component{
	constructor(props){
		super(props);

		this.state = {
			value: '',
			list: []
		}
		this.displaySelectedItem = this.displaySelectedItem.bind(this);
		this.onSelectHandle = this.onSelectHandle.bind(this);
	}
	displaySelectedItem(){
    	let selectedItem = this.props.selectedItems;
    	return (selectedItem.map( (tag) => (
              <span 
				key={tag.id} 
				style={{marginRight: '10px', cursor: 'pointer'}} 
				className="label label-primary"
				onClick={()=>this.props.onClickTagHandle(tag.id)}
              >
              	{tag.name}
              	<i style={{paddingLeft: '10px'}} className="fa fa-times"></i>
              </span>
            )
          )
    	);
    }
    onSelectHandle(value, item){
    	this.props.onSelectTagHandle(value, {id: item.id, name: item.name});
    	this.setState({value});
    }
	render(){
		let {label, errorText, list} = {...this.props}
		return(
			<div className={(!errorText)?'form-group':'form-group has-error'}>
    			<label>{label}</label>
    			<div>
            		<ReactAutocomplete
				        items={list}
				        shouldItemRender={(item, value) => (value!=='')?item.name.toLowerCase().indexOf(value.toLowerCase()) > -1:''}
				        getItemValue={item => item.name}
				        renderItem={(item, highlighted) =>
				          <div
				            key={item.id}
				            style={{ backgroundColor: highlighted ? '#eee' : 'transparent'}}
				          >
				            {item.name}
				          </div>
				        }
				        value={this.state.value}
				        onChange={e => this.setState({ value: e.target.value })}
				        onSelect={this.onSelectHandle}
			      	/>
		      	</div>
		      	<div>
		      		{this.displaySelectedItem()}
		      	</div>
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