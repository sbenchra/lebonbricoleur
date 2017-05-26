var app = new Vue({
	el: '#app',
	data: {
		annonces: [],
		titre: '',
		description: '',
		adresse: '',
		dateLimite: '',
		budgetInitial: '',
		stats: {},
		success: false
	},

	methods: {
		fetchData() {
				axios.get('/annonces/getLastFive')
				.then(function (response) {
					app.annonces = response.data;
					console.log(response.data);
				})
				.catch(function (error) {
					console.log(error);
				});
			},

			fetchStats() {
				axios.get('/annonces/stats')
				.then(function (response) {
					app.stats = response.data;
					console.log(response.data);
				})
				.catch(function (error) {
					console.log(error);
				});
			},

			timeSince(date) {

				var seconds = Math.floor(((new Date() - Date.parse(date)))/ 1000);

				var interval = Math.floor(seconds / 31536000);

				if (interval > 1) {
					return interval + " années";
				}
				interval = Math.floor(seconds / 2592000);
				if (interval > 1) {
					return interval + " mois";
				}
				interval = Math.floor(seconds / 86400);
				if (interval > 1) {
					return interval + " jours";
				}
				interval = Math.floor(seconds / 3600);
				if (interval > 1) {
					return interval + " heures";
				}
				interval = Math.floor(seconds / 60);
				if (interval > 1) {
					return interval + " minutes";
				}
				return Math.floor(seconds) + " secondes";
			},
			addAnnonce() {
				axios.post('/annonces', {
					titre : app.titre,
					description : app.description,
					adresse : app.adresse,
					metiers : $('#pre-selected-options').val(),
					date_limite: app.dateLimite,
					budget_initial: app.budgetInitial
				})
				.then(function (response) {
					app.success = response.data.message;
					console.log(response);
				})
				.catch(function (error) {
					console.log(error);	
				});
				this.fetchData();
				this.fetchStats();
				//$('#add_annonce_modal').modal('hide');
			},
			houseKeeping() {
				this.titre = '';
				this.description = '';
				this.success = false;
			},
	},

	mounted: function() {
		this.loading = true;
		this.fetchData();
		this.fetchStats();
		this.loading = false;
	},
});
