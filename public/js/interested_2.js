var app = new Vue({
	el: "#app",

	data: {
		bricoleurs: [],
		success : false,
		rating: ''
	},

	methods: {
		fetchInterestedBricoleurs() {
			axios.get('/interested/' + $('#id').val() + '/choosed')
			.then(function (response) {
					app.bricoleurs = response.data;
					console.log(response.data);
				})
			.catch(function (error) {
					console.log(error);
			});
		}, 

		getRating() {
			axios.get('/interested/' + $('#id').val() + '/choosed/rating')
			.then(function (response) {
					app.rating = response.data.rating;
					console.log(response.data);
				})
			.catch(function (error) {
					console.log(error);
			});
		}
	},

	mounted: function() {
		this.fetchInterestedBricoleurs();
		this.getRating();
		var i;
		for (i = 0; i < 5 ; i++) {
			if (i < parseInt(this.rating)) {
				$('#rating').append('<span class="glyphicon .glyphicon-star glyphicon-star"></span>');
			} else {
				$('#rating').append('<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>');
			}
		}
	}
});