<script>
	
	export default{
		props:[
			'attributes'
		],
		
		data(){
			return {
				editing:false,
				body:this.attributes.body,
				liked:this.attributes.isLiked,
				unliked :this.attributes.isUnliked,
			};
		},
		computed:{
			likedClasses(){
				return ['fa','fa-thumbs-up', this.liked ? 'text-danger':''];
			},
			unlikedClasses(){
				return ['fa','fa-thumbs-down', this.unliked ? 'text-danger':''];
			},
		},
		methods:{
			update(){
				//console.log(this.body,this.attributes.id)
				var response = axios.patch('/posts/'+this.attributes.id ,{
					body:this.body,
				});
				this.editing = false;
				//flash('updated','s')	;
			},

			delete(){
				//this.remove();
				
				axios.delete('/posts/'+this.attributes.id ,{
					body:this.body,
				});
			},
			like(){
				var response = axios.post('/posts/'+this.attributes.id+'/like' ,{
				
				});
				if(this.unliked && !this.liked)
				{
					this.unliked = !this.unliked;
				}
				this.liked = !this.liked;
			},
			unlike(){
				var response = axios.post('/posts/'+this.attributes.id+'/unlike' ,{
					body:this.body,
				});

				if(this.liked && !this.unliked)
				{
					this.liked = !this.liked;
				}
				this.unliked = !this.unliked;
			}

		}
	}
</script>