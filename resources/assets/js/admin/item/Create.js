import React from 'react';
import TextInput from '../TextInput';
import SearchBox from '../SearchBox';
import UploadFile from '../UploadFile';

import StarRatingComponent from 'react-star-rating-component';

export default class Create extends React.Component{
	constructor(props){
		super(props);

		this.state = {
			name: '',
			desc: '',
			image: null,
			errorInputName: '',
			errorInputDesc: '',
			errorInputImage: '',
			errorInputTag: '',
			rating: 1,
			isFirstClick: true,

			tags: []
		}

		this.clickBtnHandle = this.clickBtnHandle.bind(this);
		this.validateName = this.validateName.bind(this);
		this.validateDesc = this.validateDesc.bind(this);
		this.onStarClick = this.onStarClick.bind(this);
		this.onSelectTagHandle = this.onSelectTagHandle.bind(this);
		this.onClickTagHandle = this.onClickTagHandle.bind(this);
		this.validateImage = this.validateImage.bind(this);
	}
	clickBtnHandle(){
		//console.log(this.state);
		if(this.state.isFirstClick){
	        /*
	         * Fields haven't been modified
	         */
        	this.setState({
        		errorInputName: (!this.state.name&&!this.state.errorInputName)?'Fill this field':this.state.errorInputName,
				errorInputDesc: (!this.state.desc&&!this.state.errorInputDesc)?'Fill this field':this.state.errorInputDesc,
				errorInputImage: (!this.state.image&&!this.state.errorInputImage)?'Choose image file':this.state.errorInputImage,
				errorInputTag: (this.state.tags.length===0&&!this.state.errorInputTag)?'Choose any tag':this.state.errorInputTag,
				isFirstClick: false
        	});
	    console.log('first time');
	    }
	    else{
	    	//The next time
	    	console.log('The next time');
	    }
	}
	validateName(txt){
		if(txt.length < 3){
			this.setState({
				errorInputName: 'This field must be at least 3 characters long'
			});
			return;
		}
		else{
			this.setState({
				errorInputName: '',
				name: txt
			});
		}
	}
	validateDesc(txt){
		if(txt.length < 5){
			this.setState({
				errorInputDesc: 'This field must be at least 5 characters long'
			});
			return;
		}
		else{
			this.setState({
				errorInputDesc: '',
				desc: txt
			});
		}
	}
	onStarClick(nextValue, prevValue, name) {
        this.setState({rating: nextValue});
    }
    onSelectTagHandle(value, tag){
    	let tags = this.state.tags;
    	let tag_index = tags.findIndex(item => item.id === tag.id);
    	if(tag_index === -1){
    		//Add
    		tags.push(tag);
    		this.setState({
    			tags: tags,
    			errorInputTag:''
    		});
    	}
    }
    onClickTagHandle(tag_id){
    	let tags = this.state.tags;
    	let tag_index = tags.findIndex(item => item.id === tag_id);
    	if(tag_index !== -1){
    		//Delete
    		tags.splice(tag_index, 1);
    		this.setState({
    			tags: tags,
    			errorInputTag: (tags.length === 0)? 'Choose any tag':''
    		});
    	}
    }
    validateImage(e){
    	//console.log(e.target.files[0]) //File will be uploaded

    	let fileName = e.target.value;
    	let lastIndex = fileName.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        fileName = fileName.substring(lastIndex +1);
	    }
	    //console.log(fileName);
	    var reg = /(.*?)\.(jpg|jpeg|png)$/;
	    if(!fileName.match(reg))
	    {
	    	this.setState({
	    		errorInputImage: 'Invalid file (recommnend .jpg, .jpeg, .png extension)',
	    		image: null
	    	})
	    	return;
	    }
	    else{
	    	this.setState({
	    		errorInputImage: '',
	    		image: e.target.files[0]
	    	})
	    }
    }
	render(){
		let rating = this.state.rating;
		return(
			<div className="box box-primary">
				<div className="box-body">
					<TextInput 
						label='Name' 
						name='name' 
						placeholder='Tag name'
						onBlurHandle={this.validateName}
						errorText={this.state.errorInputName}	
					/>
					<TextInput 
						label='Description' 
						name='desc' 
						placeholder='Tag description'
						onBlurHandle={this.validateDesc}
						errorText={this.state.errorInputDesc}
					/>
					<div className='form-group'>
		                <label>Rating {rating}</label>
		                <div style={{fontSize: '200%'}}>
			                <StarRatingComponent 
			                    name="rate1" 
			                    starCount={10}
			                    value={rating}
			                    onStarClick={this.onStarClick}
			                />
		                </div>
            		</div>

				    <SearchBox
				    	label='Tag'
				    	selectedTags={this.state.tags}
				    	onSelectTagHandle={this.onSelectTagHandle}
				    	onClickTagHandle={this.onClickTagHandle}
				    	errorText={this.state.errorInputTag}
				    />

				    <UploadFile
				    	label='Image file' 
						name='image'
						errorText={this.state.errorInputImage}	
				    	onChangeHandle={this.validateImage}
				    />

				</div>
				<div className="box-footer">
					<button 
						className="btn btn-primary"
						onClick={this.clickBtnHandle}
					>
						<i className="fa fa-share" aria-hidden="true"></i> Create
					</button>
				</div>
			</div>
		);
	}
}