import React from 'react';
import TextInput from '../TextInput';
import SearchBox from '../SearchBox';
import UploadFile from '../UploadFile';
import Image from '../Image';

import StarRatingComponent from 'react-star-rating-component';

export default class Edit extends React.Component{
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
			rate: 1,

			oldTags: [],
			tags: [],
			tagList: [],

			currentImage: ''
		}

		this.clickBtnHandle = this.clickBtnHandle.bind(this);
		this.validateName = this.validateName.bind(this);
		this.validateDesc = this.validateDesc.bind(this);
		this.onStarClick = this.onStarClick.bind(this);
		this.onSelectTagHandle = this.onSelectTagHandle.bind(this);
		this.onClickTagHandle = this.onClickTagHandle.bind(this);
		this.validateImage = this.validateImage.bind(this);
		this.onClickDeleteImageHandle = this.onClickDeleteImageHandle.bind(this);
	}
	componentDidMount(){
		let item_id = document.getElementById('root').getAttribute("data-item-id");
		//Get item detail
		fetch('/admin/item/'+item_id, {
			credentials: 'same-origin'
		})
		.then(function(response) {
			return response.json()
		}).then(function(obj) {
			//console.log('Data Response: ', obj);
			this.setState({
				'name': obj.name,
				'desc': obj.desc,
				'rate': obj.rate,
				'currentImage': obj.image
			});
		}.bind(this))
		.catch(function(ex) {
			console.log('parsing failed', ex)
		});

		//Get current tags of item
		fetch('/admin/item/getTags/'+item_id, {
			credentials: 'same-origin'
		})
		.then(function(response) {
			return response.json()
		}).then(function(obj) {
			this.setState({
				tags: obj,
				oldTags: [...obj] //Clone
			})
		}.bind(this))
		.catch(function(ex) {
			console.log('parsing failed', ex)
		});

		//Get tag list
		fetch('/admin/tag/list', {
			credentials: 'same-origin'
		})
		.then(function(response) {
			return response.json()
		}).then(function(obj) {
			this.setState({tagList: obj})
		}.bind(this))
		.catch(function(ex) {
			console.log('parsing failed', ex)
		});
	}
	clickBtnHandle(){
		let {
			errorInputName, 
			errorInputDesc, 
			errorInputImage, 
			errorInputTag,
			name,
			desc,
			oldTags,
			tags,
			image,
			rate,
			currentImage
		} = {...this.state};

		if(!image&&!currentImage&&!errorInputImage){
			console.log('Error, required image');
			this.setState({errorInputImage: 'Choose image file'});
			return;
		}
		if(!name||!desc||tags.length===0||(!image&&!currentImage))
			console.log('Error');
		else{
			console.log('Submit');

			// console.log(oldTags, tags);
			// return;

			let before = new Set(oldTags);
    		let after = new Set(tags);

    		let added = new Set();
		    added = this.difference(after, before);

		    let removed = new Set();
		    removed = this.difference(before, after);

		    let addedArr = Array.from(added);
    		let removedArr = Array.from(removed);

    		//console.log(oldTags, tags);

		 	console.log(addedArr);
		 	console.log(removedArr);
			return;


			//Submit
    		let _token = document.getElementsByName("csrf-token")[0].getAttribute("content");
			let formData = new FormData();
		    formData.append('name', name);
		    formData.append('desc', desc);
		    formData.append('rate', rate);
		    formData.append('tags', JSON.stringify(tags));
		    formData.append('image', image);

		    //Token
    		formData.append('_token', _token);

    		//POST (AJAX)
		    fetch('/admin/item', {
		    	method: 'POST',
		    	credentials: 'same-origin',
		    	body: formData
		    })
		    .then(function(response) {
		      return response.json()
		    }).then(function(obj) {
		    	//console.log(obj)
		    	if(obj.state === 1){
		    		alert('Successfully created!')
		    		window.location = "/admin/item";
		    	}
		    	else{
		    		alert('Error from server!');
		    	}
		    }.bind(this))
		    .catch(function(ex) {
		      //Log Error
		      console.log('parsing failed', ex)
		    });
		}
	}
	validateName(txt){
		if(txt.length < 3){
			this.setState({
				errorInputName: 'This field must be at least 3 characters long',
				name: ''
			});
			return;
		}
		else{
			//Check unique name
			fetch('/admin/item/checkName/'+txt, {
				credentials: 'same-origin'
			})
			.then(function(response) {
				return response.json()
			}).then(function(obj) {
				//Data Response
				// console.log('Data Response: ', obj);
				this.setState({
					errorInputName: (obj.state === 1)?'':obj.message,
					name: (obj.state === 1)?txt:''
				});
			}.bind(this))
			.catch(function(ex) {
				console.log('parsing failed', ex)
			});
			return;
		}
	}
	validateDesc(txt){
		if(txt.length < 5){
			this.setState({
				errorInputDesc: 'This field must be at least 5 characters long',
				desc: ''
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
        this.setState({rate: nextValue});
    }
    onSelectTagHandle(value, tag){
    	let tags = this.state.tags;
    	let oldTags = this.state.oldTags;
    	let tag_index = tags.findIndex(item => item.id === tag.id);
    	if(tag_index === -1){
    		//Add
    		let old_tag_index = oldTags.findIndex(item => item.id === tag.id);
    		if(old_tag_index === -1)
    			tags.push(tag);
    		else
    			tags.push(oldTags[old_tag_index]);
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
    onClickDeleteImageHandle(){
    	if(confirm('Do you want to delete this image?')){
			this.setState({currentImage: ''});
		}
		return;
    }
    difference(setA, setB){
    	var difference = new Set(setA);
    	for (var elem of setB) {
    		difference.delete(elem);
    	}
    	return difference;
    }
	render(){
		let rate = this.state.rate;
		let currentImage = this.state.currentImage;
		return(
			<div className="box box-primary">
				<div className="box-body">
					<TextInput 
						label='Name' 
						name='name' 
						placeholder='Tag name'
						value={this.state.name}
						onBlurHandle={this.validateName}
						errorText={this.state.errorInputName}
					/>
					<TextInput 
						label='Description' 
						name='desc' 
						placeholder='Tag description'
						value={this.state.desc}
						onBlurHandle={this.validateDesc}
						errorText={this.state.errorInputDesc}
					/>
					<div className='form-group'>
		                <label>Rating {rate}</label>
		                <div style={{fontSize: '200%'}}>
			                <StarRatingComponent 
			                    name="rate1" 
			                    starCount={10}
			                    value={rate}
			                    onStarClick={this.onStarClick}
			                />
		                </div>
            		</div>

				    <SearchBox
				    	label='Tag'
				    	selectedItems={this.state.tags}
				    	onSelectTagHandle={this.onSelectTagHandle}
				    	onClickTagHandle={this.onClickTagHandle}
				    	errorText={this.state.errorInputTag}
				    	list={this.state.tagList}
				    />
				    {
				    	(currentImage)?
				    	<Image 
				    		src={'/storage/'+currentImage}
				    		handleClick={this.onClickDeleteImageHandle}
				    	/>
				    	:
				    	<UploadFile
					    	label='Image file' 
							name='image'
							errorText={this.state.errorInputImage}	
					    	onChangeHandle={this.validateImage}
				    	/>
				    }
				   
				</div>
				<div className="box-footer">
					<button 
						className="btn btn-primary"
						onClick={this.clickBtnHandle}
					>
						<i className="fa fa-share" aria-hidden="true"></i> Update
					</button>
				</div>
			</div>
		);
	}
}