var app = new Vue({
	el: "#app",

	data: {
		bricoleurs: [],
		success : false
	},

	methods: {
		fetchInterestedBricoleurs() {
			axios.get('/interested/' + $('#id').val())
			.then(function (response) {
					app.bricoleurs = response.data;
					console.log(response.data);
				})
			.catch(function (error) {
					console.log(error);
			});
		}, 
	},

	mounted: function() {
		this.fetchInterestedBricoleurs();
	}
});