<template>
	
	
</template>

<script>
	
	export default {

		data(){

			return {

				myusers : [],
				user : {

					id : '',
					name : '',
					email : '',
					username : '',
				},
				pagination : {},

			}
		},

		created() {

			this.getUsers()
		},

		methods : {

			getUsers(){
				console.log(this.myusers);

				axios.get(`/api/users`)
					.then(response => {

						console.log(response.data.data);
					})
					.catch(error => { console.log(error) })
			},
		},
	}
</script>