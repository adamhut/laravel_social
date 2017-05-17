<template>

    		<form enctype="multipart/form-data" action="" method="POST" @submit.prevent="update">
                
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="name" class="form-control" v-model="form.name" id="name">
                </div>
				<div class="form-group">
                	<image-upload v-model="form.avatar"></image-upload>
                </div>
               
                
                <button type="submit" class="pull-right btn btn-sm btn-primary">Update</button>
            </form>
</template>

<script>
import { toMulipartedForm } from '../helpers/form';
import ImageUpload from './ImageUpload.vue';

	export default{
		props:[
			'data'
		],
		components:{ImageUpload},
		data(){
			return {
				endPoint:`/profile/${this.data.id}`,
				form:{
					//name:this.data.name,
					//avatar:this.data.avatar,
					
				},
			};
		},
		created()
		{
			Vue.set(this.$data, 'form', this.data)
			console.log(this.data);
		},
		methods:{
			update(){
				this.form._method='PATCH';
				const fd = toMulipartedForm(this.form);
				//return ;
				//console.log(form);
				//return;
				
				axios.post(this.endPoint,fd)
					.then(res=>{
						console.log(res);
						//this.refresh
					})
					.catch();
				//console.log(e);
			}

		}

	}
</script>