import React from 'react';

import ReactAutocomplete from 'react-autocomplete';

export default class SearchBox extends React.Component{
	constructor(props){
		super(props);

		this.state = {
			value: '',
		}
		this.displaySelectedTags = this.displaySelectedTags.bind(this);
	}
	displaySelectedTags(){
    	let tags = this.props.selectedTags;
    	return (tags.map( (tag) => (
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
	render(){
		let {label, errorText} = {...this.props}
		return(
			<div className={(!errorText)?'form-group':'form-group has-error'}>
    			<label>{label}</label>
    			<div>
            		<ReactAutocomplete
				        items={[
				          { id: '1', name: 'foo' },
				          { id: '2', name: 'bar' },
				          { id: '3', name: 'baz' },
				        ]}
				        shouldItemRender={(item, value) => item.name.toLowerCase().indexOf(value.toLowerCase()) > -1}
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
				        onSelect={this.props.onSelectTagHandle}
			      	/>
		      	</div>
		      	<div>
		      		{this.displaySelectedTags()}
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